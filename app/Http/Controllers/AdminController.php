<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Booking; 
use App\Models\Vehicle;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;  
use App\Mail\BookingConfirmed;
use Carbon\Carbon;
use App\Models\ContactQuery;
use App\Mail\ContactReplyMail;
use App\Mail\BookingCancelledMail;
use App\Mail\PaymentSuccessfulMail;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.adminlogin');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::guard('admin')->user();
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            } else {
                Auth::guard('admin')->logout();
                return back()->withErrors([
                    'email' => 'You do not have administrative privileges.',
                ])->onlyInput('email');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you do not have administrative access.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        $regUsersCount = User::where('role', 'user')->count();
        $listedVehiclesCount = Vehicle::count();
        $totalBookingsCount = Booking::count();
        $listedBrandsCount = Brand::count();

        // If you have models for Subscribers, Queries, Testimonials, uncomment and add them:
        // $subscribersCount = Subscriber::count();
        $totalQueries = ContactQuery::count();
        $paymentCount = Booking::where('payment_status', 'paid')->count();

        // Pass these counts to the dashboard view
        return view('admin.dashboard', compact(
            'regUsersCount',
            'listedVehiclesCount',
            'totalBookingsCount',
            'listedBrandsCount',
            'totalQueries',
            'paymentCount',
             
            // 'testimonialsCount'
        ));
    }

    public function logout(Request $request)
    {
         Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('admin.login')); 
    }

    public function bookingsIndex()
    {
        $bookings = Booking::with(['user', 'vehicle.brand'])->latest()->paginate(10); 
        return view('admin.bookings', compact('bookings'));
    }

    public function bookingsShow(Booking $booking)
    {
        $booking->load(['user', 'vehicle.brand']);
        return view('admin.bookingdetails', compact('booking'));
    }

    public function bookingsUpdateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed,rejected',
        ]);

        $newStatus = $request->status;

        if ($newStatus === 'cancelled') {
            $booking->payment_status = 'not applicable';

            Mail::to($booking->customer_email)->send(new BookingCancelledMail($booking));
        }
        
        $booking->status = $request->status;
        
        $booking->save();
        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }

    public function confirm(Booking $booking)
    {
        if ($booking->status === 'cancelled') {
            $booking->status = 'confirmed';
            $booking->payment_status = 'pending';
            $booking->save();
        
            return redirect()->back()->with('success', 'Booking has been re-confirmed. The payment status is now pending.');
        }

        return redirect()->back()->with('info', 'Booking status could not be changed.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed,rejected',
        ]);

        $newStatus = $request->input('status');

        if ($booking->status === $newStatus) {
            return redirect()->back()->with('info', "Booking is already '{$newStatus}'.");
        }

        $booking->status = $newStatus;

        if ($newStatus === 'cancelled') {
            $paymentController = new PaymentController();
            $paymentController->updateStatusForCancelledBooking($booking);
        }

        $booking->save();

        if ($newStatus === 'confirmed') {
            try {
        
                $recipientEmail = $booking->customer_email;
                if (!$recipientEmail && $booking->user) {
                    $recipientEmail = $booking->user->email;
                }

                if ($recipientEmail) {
                    Mail::to($recipientEmail)->send(new BookingConfirmed($booking));
                    session()->flash('success', "Booking status updated to '{$newStatus}' and confirmation email sent to {$recipientEmail}!");
                } else {
                    
                    \Log::warning("Booking confirmed for ID: {$booking->id}, but no recipient email found (customer_email or associated user email missing).");
                    session()->flash('warning', "Booking status updated to '{$newStatus}', but no email address found for customer to send confirmation.");
                }
            } catch (\Exception $e) {
               
                \Log::error("Failed to send booking confirmation email for Booking ID: {$booking->id}. Error: {$e->getMessage()}");
                session()->flash('error', "Booking confirmed, but failed to send email: " . $e->getMessage());
            }
        } else {
            
            session()->flash('success', "Booking status updated to '{$newStatus}' successfully!");
        }

        return redirect()->back();
    }

    public function update(Request $request, Booking $booking)
    {
        $fieldName = $request->input('field');
        $newValue = $request->input('value');
        $updatedData = [];

        try {
            if ($fieldName === 'status') {
                $request->validate(['value' => 'required|in:pending,confirmed,completed,rejected,cancelled']);
                $updatedData['status'] = $newValue;

            } elseif ($fieldName === 'pickup_date' || $fieldName === 'dropoff_date') {
                
                $pickupDateString = ($fieldName === 'pickup_date') ? $newValue : $booking->pickup_date;
                $dropoffDateString = ($fieldName === 'dropoff_date') ? $newValue : $booking->dropoff_date;

                $validator = Validator::make([
                    'pickup_date' => $pickupDateString,
                    'dropoff_date' => $dropoffDateString,
                ], [
                    'pickup_date' => 'required|date',
                    'dropoff_date' => 'required|date|after_or_equal:pickup_date', 
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                $pickupDate = Carbon::parse($pickupDateString);
                $dropoffDate = Carbon::parse($dropoffDateString);

                $updatedData[$fieldName] = $newValue;
                
                $rentalDays = abs($dropoffDate->diffInDays($pickupDate));
                if ($rentalDays === 0) {
                    $rentalDays = 1;
                }

                $vehicle = $booking->vehicle;
                if ($vehicle) {
                    $newTotalAmount = $rentalDays * $vehicle->price_per_day;
                    $updatedData['total_amount'] = $newTotalAmount;
                }
            } else {
                return response()->json(['message' => 'Invalid field name provided.'], 400);
            }
            
            if (!empty($updatedData)) {
                $booking->update($updatedData);
                $booking->refresh();
            }

            return response()->json([
                'success' => true,
                'message' => 'Booking updated successfully.',
                'total_amount' => $booking->total_amount,
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred during the update.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function manageContactQueries()
    {
        $queries = ContactQuery::latest()->get();
        return view('admin.contact', compact('queries'));
    }

    public function replyToQuery(Request $request, ContactQuery $query)
    {
        $request->validate([
            'reply_message' => 'required|string',
        ]);

        $replyDetails = [
            'original_name' => $query->name,
            'original_subject' => $query->subject,
            'original_message' => $query->message,
            'reply_message' => $request->input('reply_message')
        ];

        Mail::to($query->email)->send(new ContactReplyMail($replyDetails));

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }

    public function cancelBooking(Request $request, Booking $booking)
    {
        $hasPaid = ($booking->payment_status === 'paid');

        $booking->status = 'cancelled';
        $booking->payment_status = 'not applicable';
        $booking->save();

        Mail::to($booking->customer_email)->send(new BookingCancelledMail($booking));

        $successMessage = 'Booking has been cancelled.';
        if ($hasPaid) {
            $successMessage = ' You will receive your refund in the next 24 hours.';
        }

        return redirect()->route('my.bookings')->with('success', $successMessage);
    }

    public function processRefund(Request $request, Booking $booking)
    {
        $booking->payment_status = 'refunded';
        $booking->save();

        Mail::to($booking->customer_email)->send(new PaymentSuccessfulMail($booking, true));

        return redirect()->back()->with('success', 'Refund sent successfully!');
    }
    
}