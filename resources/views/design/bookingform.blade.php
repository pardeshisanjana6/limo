@extends('users.userlayout') 

@section('content')
<br><br><br>
<section class="booking-form-section py-5">
    <div class="container">
        <h1 class="mb-4 text-center">Confirm Your Booking</h1>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

       @unless (session('success'))
        <form action="{{ route('booking.store', $vehicle->id) }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            <h3 class="mb-3">Vehicle: {{ $vehicle->vehicle_title }} ({{ $vehicle->brand->name ?? 'N/A' }})</h3>
            <div class="row mb-4">
                <div class="col-md-6">
                    <img src="{{ asset($vehicle->image_path) }}" class="img-fluid rounded" alt="{{ $vehicle->vehicle_title }}">
                </div>
                <div class="col-md-6"> 
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><strong>Price per Day:</strong> ₹<span id="daily-rate">{{ $vehicle->price_per_day }}</span></li>
                    </ul>
                    <div class="mb-3">
                        <label for="pickup_date" class="form-label">Pickup Date:</label>
                        <input type="date" id="pickup_date" name="pickup_date" class="form-control" required min="{{ date('Y-m-d') }}" value="{{ old('pickup_date') }}">
                    </div>
                    <div class="mb-3">
                        <label for="dropoff_date" class="form-label">Drop-off Date:</label>
                        <input type="date" id="dropoff_date" name="dropoff_date" class="form-control" required min="{{ date('Y-m-d') }}" value="{{ old('dropoff_date') }}">
                    </div>
                    <div class="mb-3">
                        <label for="pickup_time" class="form-label">Pickup Time:</label>
                        <input type="time" id="pickup_time" name="pickup_time" class="form-control" value="{{ old('pickup_time', '09:00') }}" required>
                    </div>

                    <div>
                        <div id="availability-status"></div>
                    </div>

                    <div class="mb-3">
                        <strong>Total Amount: ₹<span id="total-amount">0.00</span></strong>
                    </div>

                    <input type="hidden" name="total_amount" id="calculated-total-amount-input" value="{{ old('total_amount', '0.00') }}">
                </div>
            </div> 

            <hr>

            <h3 class="mb-3">Customer Details</h3>
            
            <div class="mb-3">
                <label for="customer_name" class="form-label">Your Name</label>
                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name', Auth::user()->name ?? '') }}" required>
                @error('customer_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="customer_email" class="form-label">Your Email</label>
                <input type="email" class="form-control @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" value="{{ old('customer_email', Auth::user()->email ?? '') }}" required>
                @error('customer_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="customer_address" class="form-label">Your Address</label>
                <input type="text" class="form-control @error('customer_address') is-invalid @enderror" id="customer_address" name="customer_address" value="{{ old('customer_address') }}" required>
                @error('customer_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="customer_mobile" class="form-label">Your Mobile Number</label>
                <input type="tel" class="form-control @error('customer_mobile') is-invalid @enderror" id="customer_mobile" name="customer_mobile" value="{{ old('customer_mobile') }}" required pattern="[0-9]{10,15}" title="Please enter a valid mobile number (10-15 digits)">
                @error('customer_mobile')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success  mt-3">Confirm Booking</button>
        </form> 
        @endunless

                 @if (session('success'))
            <div class="card p-4 shadow-sm text-center">
                <h4 class="text-success mb-4">Booking Confirmed!</h4>
                <p>Your booking for {{ $vehicle->vehicle_title }} ({{ $vehicle->brand->name ?? 'N/A' }}) has been successfully placed.</p>
                <p>You will receive a confirmation email shortly. Thanks for choosing our services!</p>
                <a href="{{ route('home2') }}" class="btn btn-primary mt-4">Back to Home Page</a> 
            </div>
        @endif
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pickupDateInput = document.getElementById('pickup_date');
        const dropoffDateInput = document.getElementById('dropoff_date');
        const dailyRateSpan = document.getElementById('daily-rate');
        const totalAmountSpan = document.getElementById('total-amount');
        const calculatedTotalAmountInput = document.getElementById('calculated-total-amount-input'); // This input will send the amount

        function calculateTotal() {
            const pickupDate = new Date(pickupDateInput.value);
            const dropoffDate = new Date(dropoffDateInput.value);
            const dailyRate = parseFloat(dailyRateSpan.textContent);

            if (isNaN(pickupDate) || isNaN(dropoffDate) || pickupDateInput.value === "" || dropoffDateInput.value === "") {
                totalAmountSpan.textContent = '0.00';
                calculatedTotalAmountInput.value = '0.00';
                return;
            }

            if (dropoffDate < pickupDate) {
                alert('Drop-off date cannot be before pickup date. Adjusting drop-off date to match pickup date.');
                dropoffDateInput.value = pickupDateInput.value;
                dropoffDate = new Date(pickupDateInput.value);
            }

            const diffTime = Math.abs(dropoffDate.getTime() - pickupDate.getTime());
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            const rentalDays = diffDays === 0 ? 1 : diffDays;

            const totalAmount = (rentalDays * dailyRate).toFixed(2);
            totalAmountSpan.textContent = totalAmount;
            calculatedTotalAmountInput.value = totalAmount;
        }

        const today = new Date();
        const yyyy = today.getFullYear();
        let mm = today.getMonth() + 1;
        let dd = today.getDate();

        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;

        const formattedToday = yyyy + '-' + mm + '-' + dd;
        pickupDateInput.setAttribute('min', formattedToday);
        dropoffDateInput.setAttribute('min', formattedToday);

        pickupDateInput.addEventListener('change', calculateTotal);
        dropoffDateInput.addEventListener('change', calculateTotal);

        pickupDateInput.addEventListener('change', function() {
            dropoffDateInput.setAttribute('min', this.value);
            if (new Date(dropoffDateInput.value) < new Date(this.value)) {
                dropoffDateInput.value = this.value;
            }
            calculateTotal();
        });

        calculateTotal();
    });

    document.addEventListener('DOMContentLoaded', function () {
    const pickupDateInput = document.getElementById('pickup_date');
    const dropoffDateInput = document.getElementById('dropoff_date');
    const vehicleId = {{ $vehicle->id }};
    const statusDiv = document.getElementById('availability-status');

    function checkVehicleAvailability() {
        const pickupDate = pickupDateInput.value;
        const dropoffDate = dropoffDateInput.value;

        if (pickupDate && dropoffDate) {
            const postData = {
                vehicle_id: vehicleId,
                pickup_date: pickupDate,
                dropoff_date: dropoffDate
            };
            
            console.log('Sending data:', postData); // <-- This line will now work

            fetch('{{ route('api.checkAvailability') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(postData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.is_available) {
                    statusDiv.innerHTML = '<p style="color: green;">&#10004; Available for these dates</p>';
                } else {
                    statusDiv.innerHTML = '<p style="color: red;">&#10006; Not Available for these dates</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                statusDiv.innerHTML = '';
            });
        } else {
            statusDiv.innerHTML = '';
        }
    }

    if (pickupDateInput) {
        pickupDateInput.addEventListener('change', checkVehicleAvailability);
    }
    if (dropoffDateInput) {
        dropoffDateInput.addEventListener('change', checkVehicleAvailability);
    }
});
</script>
@endsection