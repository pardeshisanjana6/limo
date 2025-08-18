<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle; 
use App\Models\Brand; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    public function create()
    {
        $brands = Brand::all();
        return view('admin.vehicles.create', compact('brands'));
    }

    public function store(Request $request)
    {
        try{
        $request->validate([
            'vehicle_title' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id', 
            'vehicle_overview' => 'required|string',
            'price_per_day' => 'required|numeric|min:0',
            'fuel_type' => 'required|string', 
            'model_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'seating_capacity' => 'required|integer|min:1|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'accessories' => 'nullable|array',
            'accessories.*' => 'string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); 
            $destinationPath = public_path('/images'); 

            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/' . $imageName;
        }

        Vehicle::create([
            'vehicle_title' => $request->vehicle_title,
            'brand_id' => $request->brand_id, 
            'vehicle_overview' => $request->vehicle_overview,
            'price_per_day' => $request->price_per_day,
            'fuel_type' => $request->fuel_type, 
            'model_year' => $request->model_year,
            'seating_capacity' => $request->seating_capacity,
            'image_path' => $imagePath, 
            'accessories' => json_encode($request->accessories), 
        ]);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle posted successfully!');
    } catch (\Illuminate\Validation\ValidationException $e) {
       
        return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
       
        \Log::error("Error adding vehicle: " . $e->getMessage()); 
        return redirect()->back()->with('error', 'Failed to add vehicle. Please try again.')->withInput();
    }
    }

    public function index()
    {
        $vehicles = \App\Models\Vehicle::with('brand')->get(); 
        return view('admin.vehicles.index', compact('vehicles'));

    }

    public function destroy(Vehicle $vehicle) 
    {
        if ($vehicle->image_path && File::exists(public_path($vehicle->image_path))) {
            File::delete(public_path($vehicle->image_path));
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle deleted successfully!');
    }

    public function showVehicleDetails(Request $request, Vehicle $vehicle)
    {
    // Redirect to login if user is not authenticated
    if (!Auth::check()) {
        // Carry forward the dates to the login page
        return redirect()->route('login')->with('status', 'Please log in to view vehicle details and proceed with rental.')->withInput([
            'pickup_date' => $request->query('pickup_date'),
            'dropoff_date' => $request->query('dropoff_date')
        ]);
    }

    $pickupDate = $request->query('pickup_date');
    $dropoffDate = $request->query('dropoff_date');

    // Assume the car is available by default
    $isAvailable = true;

    // Only perform the availability check if dates are provided
    if ($pickupDate && $dropoffDate) {
        $conflictingBooking = Booking::where('vehicle_id', $vehicle->id)
            ->where(function ($query) use ($pickupDate, $dropoffDate) {
                $query->where('pickup_date', '<=', $dropoffDate)
                      ->where('dropoff_date', '>=', $pickupDate);
            })
            ->whereNotIn('status', ['cancelled', 'rejected', 'completed'])
            ->exists();

        // If a conflicting booking exists, the car is not available
        if ($conflictingBooking) {
            $isAvailable = false;
        }
    }

    // Pass all necessary data to the view
    return view('design.vehicledetails', compact('vehicle', 'isAvailable', 'pickupDate', 'dropoffDate'));
    }

    public function showBookingForm(Request $request, Vehicle $vehicle)
    {
        return view('design.bookingform', compact('vehicle'));
    }

    public function storeBooking(Request $request, Vehicle $vehicle)
    {
        $user = Auth::user();

        try {
            $validatedData = $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|string|email|max:255',
                'customer_address' => 'required|string|max:500', 
                'customer_mobile' => 'required|string|min:10|max:15',
                'pickup_date' => 'required|date|after_or_equal:today',
                'dropoff_date' => 'required|date|after_or_equal:pickup_date',
                'pickup_time' => 'required|date_format:H:i',
                'total_amount' => 'required|numeric|min:0.01',
            ]);

            $booking = Booking::create([
                'user_id' => $user->id,
                'vehicle_id' => $vehicle->id,
                'customer_name' => $validatedData['customer_name'],
                'customer_email' => $validatedData['customer_email'],
                'customer_address' => $validatedData['customer_address'], 
                'customer_mobile' => $validatedData['customer_mobile'],   
                'pickup_date' => $validatedData['pickup_date'],
                'dropoff_date' => $validatedData['dropoff_date'],
                'pickup_time' => $validatedData['pickup_time'],
                'total_amount' => $validatedData['total_amount'],
                'status' => 'pending',
            ]);

            
           return redirect()->back()->with('success', 'You will receive a confirmation mail shortly. Thanks for choosing our services!');

        } catch (ValidationException $e) {
            
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', 'An error occurred during booking. Please try again.')->withInput();
        }
    }

    private function calculateRentalCost($dailyRate, $pickupDate, $dropoffDate)
    {
        $pickup = new \DateTime($pickupDate);
        $dropoff = new \DateTime($dropoffDate);
        $interval = $pickup->diff($dropoff);
        $days = $interval->days;

        $rentalDays = ($days === 0 && $pickupDate === $dropoffDate) ? 1 : $days;
        if ($rentalDays < 1) {
            $rentalDays = 1;
        }
        return ($rentalDays * $dailyRate);
    }

    public function brandsIndex()
    {
        $brands = Brand::withCount('vehicles')->oldest()->paginate(10);
        return view('admin.vehicles.brand', compact('brands')); 
    }

    public function vehiclesByBrand(Brand $brand)
    {
        $vehicles = $brand->vehicles()->latest()->paginate(10);

        return view('admin.vehicles.brandvehicleslist', compact('vehicles', 'brand'));
    }

    public function destroyBrand(Brand $brand)
    {
        try {
            if ($brand->vehicles()->count() > 0) {
                return redirect()->back()->with('error', 'Cannot delete brand. There are vehicles associated with it. Please reassign or delete vehicles first.');
            }

            $brandName = $brand->name; 
            $brand->delete();

            return redirect()->route('admin.brands.index')->with('success', "Brand '{$brandName}' deleted successfully!");

        } catch (\Exception $e) {
            Log::error('Error deleting brand ' . $brand->id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete brand. An error occurred.');
        }
    }

    public function storeBrand(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:brands,name',
            ]);

            Brand::create([
                'name' => $request->input('name'),
            ]);

            return redirect()->route('admin.brands.index')->with('success', 'Brand added successfully!');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Error adding brand: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add brand. Please try again.')->withInput();
        }
    }

    public function edit(Vehicle $vehicle)
    {
        $brands = Brand::all();
        return view('admin.vehicles.edit', compact('vehicle', 'brands'));
    }

    public function updateVehicle(Request $request, Vehicle $vehicle)
{
    $request->validate([
        'vehicle_title' => 'required|string|max:255',
        'brand_id' => 'required|exists:brands,id',
        'price_per_day' => 'required|numeric|min:0',
        'fuel_type' => 'required|string',
        'model_year' => 'required|numeric|min:1900|max:' . date('Y'),
        'seating_capacity' => 'required|numeric|min:1',
        'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $updatedData = $request->except(['_token', '_method', 'image_path']);

    if ($request->hasFile('image_path')) {
        if ($vehicle->image_path && Storage::exists('public/' . $vehicle->image_path)) {
            Storage::delete('public/' . $vehicle->image_path);
        }

        $path = $request->file('image_path')->store('public/images/vehicles');
        $updatedData['image_path'] = str_replace('public/', '', $path);
    }

    $vehicle->update($updatedData);

    return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully!');
}
}