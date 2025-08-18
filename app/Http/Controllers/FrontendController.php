<?php

namespace App\Http\Controllers;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\ContactQuery;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index(){
        return view('design.index');
    }

    public function layout(){
        return view('design.layout');
    }

    public function about(){
        return view('design.about');
    }

    public function myBookings()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Please log in to view your bookings.');
        }
        $userId = Auth::id();
        $bookings = Booking::where('user_id', $userId)
                            ->orderBy('created_at', 'desc')
                            ->with('vehicle.brand')
                            ->get();

        return view('design.booking', compact('bookings'));
    }

    public function cars(Request $request)
    {
        $query = Vehicle::query()->with('brand');
        $selectedSeatingCapacity = $request->input('seating_capacity');
        if ($selectedSeatingCapacity && $selectedSeatingCapacity !== 'all') {
            $query->where('seating_capacity', $selectedSeatingCapacity);
        }
        
        $pickupDateString = $request->input('pickup_date');
        $dropoffDateString = $request->input('dropoff_date');
        $bookedVehicleIds = [];

        if ($pickupDateString && $dropoffDateString) {
            try {
                $pickupDate = Carbon::createFromFormat('m/d/Y', $pickupDateString)->format('Y-m-d');
                $dropoffDate = Carbon::createFromFormat('m/d/Y', $dropoffDateString)->format('Y-m-d');
            } catch (\Exception $e) {
                $pickupDate = null;
                $dropoffDate = null;
            }

            if ($pickupDate && $dropoffDate) {
                $bookedVehicleIds = Booking::where(function ($q) use ($pickupDate, $dropoffDate) {
                    $q->where('pickup_date', '<=', $dropoffDate)
                      ->where('dropoff_date', '>=', $pickupDate);
                })
                ->whereNotIn('status', ['cancelled', 'rejected', 'completed'])
                ->pluck('vehicle_id')
                ->toArray();
                
                $query->whereNotIn('id', $bookedVehicleIds);
            }
        }
        
        $vehicles = $query->get();

        $allSeatingCapacities = Vehicle::distinct()
            ->whereNotNull('seating_capacity')
            ->pluck('seating_capacity')
            ->sort(function ($a, $b) { return $a <=> $b; })
            ->values();

        $allFuelTypes = Vehicle::distinct()
            ->whereNotNull('fuel_type')
            ->pluck('fuel_type')
            ->sort()
            ->values();

        return view('design.cars', [
            'vehicles' => $vehicles,
            'selectedSeatingCapacity' => $selectedSeatingCapacity,
            'allSeatingCapacities' => $allSeatingCapacities,
            'allFuelTypes' => $allFuelTypes,
            'pickupDate' => $pickupDateString,
            'dropoffDate' => $dropoffDateString,
        ]);
    }

    public function blog(){
        return view('design.blog');
    }

    public function contact(){
        $user = Auth::user(); 
        return view('design.contact', compact('user'));
    }

    public function sendContactEmail(Request $request)
    {
        $validatedData=$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactQuery::create($validatedData);
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function home(Request $request)
    {
        $pickupDate = $request->input('pickup_date');
        $dropoffDate = $request->input('dropoff_date');

        $vehicles = collect();
        $pageTitle = 'Some of Our Best Sellers';

        if ($pickupDate && $dropoffDate) {
            $pageTitle = 'Available Cars for Selected Dates';

            $bookedVehicleIds = Booking::where(function ($q) use ($pickupDate, $dropoffDate) {
                $q->where('pickup_date', '<=', $dropoffDate)
                ->where('dropoff_date', '>=', $pickupDate);
            })
            ->whereNotIn('status', ['cancelled', 'rejected', 'completed'])
            ->pluck('vehicle_id');

            $vehicles = Vehicle::whereNotIn('id', $bookedVehicleIds)->get();
        } else {
            $featuredVehicleIds = [12,3,5,13,4,14]; 
            $vehicles = Vehicle::whereIn('id', $featuredVehicleIds)->get();
        }

        return view('design.home', compact('vehicles', 'pickupDate', 'dropoffDate', 'pageTitle'));
    }

    public function checkAvailability(Request $request)
{
    $vehicleId = $request->input('vehicle_id');
    $pickupDate = $request->input('pickup_date');
    $dropoffDate = $request->input('dropoff_date');

    if (!$vehicleId || !$pickupDate || !$dropoffDate) {
        return response()->json(['error' => 'Missing data'], 400);
    }

    
    $isAvailable = !Booking::where('vehicle_id', $vehicleId)
        ->where(function ($q) use ($pickupDate, $dropoffDate) {
            $q->where('pickup_date', '<=', $dropoffDate)
              ->where('dropoff_date', '>=', $pickupDate);
        })
        ->whereNotIn('status', ['cancelled', 'rejected', 'completed'])
        ->exists();

    return response()->json(['is_available' => $isAvailable]);
}

}
