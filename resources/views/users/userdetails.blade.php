
@extends('admin.adminlayout')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">User Details: {{ $user->name }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Back to Users</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>User ID:</strong> {{ $user->id }}</p>
                    <p>
                        <strong>Name:</strong>
                        <span id="user-name" data-field="name" contenteditable="true" style="border-bottom: 1px dotted #000; cursor: pointer;">
                            {{ $user->name }}
                        </span>
                    </p>
                    <p>
                        <strong>Email:</strong>
                        <span id="user-email" data-field="email" contenteditable="true" style="border-bottom: 1px dotted #000; cursor: pointer;">
                            {{ $user->email }}
                        </span>
                    </p>
                    <p><strong>Role:</strong> {{ $user->role }}</p>
                    <p><strong>Registered On:</strong> {{ $user->created_at->format('M d, Y H:i A') }}</p>
                    <p><strong>Last Updated:</strong> {{ $user->updated_at->format('M d, Y H:i A') }}</p>
                </div>

            </div>

            @if ($user->bookings->count() > 0)
                <h5 class="mt-4">User's Bookings</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Vehicle</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Status</th>
                                <th>Address</th>
                                <th>Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->vehicle->vehicle_title ?? 'N/A' }}</td>
                                <td>{{ $booking->pickup_date }}</td>
                                <td>{{ $booking->dropoff_date }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>{{ $booking->customer_address ?? 'N/A' }}</td>
                                <td>{{ $booking->customer_mobile ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="mt-4">No bookings found for this user.</p>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editableFields = document.querySelectorAll('[contenteditable="true"]');
        const userId = {{ $user->id }};
        const statusMessage = document.getElementById('status-message');

        editableFields.forEach(field => {
            const originalValue = field.innerText.trim();

            field.addEventListener('blur', function () {
                const newValue = this.innerText.trim();
                const fieldName = this.getAttribute('data-field');

                if (newValue !== originalValue) {
                    const data = {
                        [fieldName]: newValue,
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    };

                    fetch('{{ route('admin.users.update', $user->id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(result => {
                        statusMessage.className = 'alert alert-success';
                        statusMessage.innerText = result.message || 'User updated successfully.';
                        field.setAttribute('data-original-value', newValue);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        let errorMessage = 'An unexpected error occurred.';
                        if (error.errors) {
                            errorMessage = Object.values(error.errors).flat().join(' ');
                        } else if (error.message) {
                            errorMessage = error.message;
                        }
                        statusMessage.className = 'alert alert-danger';
                        statusMessage.innerText = 'Error: ' + errorMessage;
                        field.innerText = originalValue;
                    });
                }
            });
        });
    });
</script>
@endsection
