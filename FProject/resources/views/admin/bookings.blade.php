@extends('admin.adminlayout')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">All Bookings</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Bookings</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Vehicle</th>
                            <th>Pickup Date</th>
                            <th>Drop-off Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->customer_name }} ({{ $booking->customer_email }})</td>
                                <td>
                                    {{ $booking->vehicle->brand->name ?? 'N/A' }} - {{ $booking->vehicle->vehicle_title ?? 'N/A' }}
                                    ({{ $booking->vehicle->model_year ?? 'N/A' }})
                                </td>
                                <td>{{ \Carbon\Carbon::parse($booking->pickup_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->dropoff_date)->format('M d, Y') }}</td>
                                <td>₹{{ number_format($booking->total_amount, 2) }}</td>
                                <td>
                                    @php
                                        $status = trim($booking->status);
                                        $status_color = 'lightgrey';
                                        $text_color = 'black';
                                            if ($status == 'pending') {
                                                $status_color = '#ffc107'; 
                                            } elseif ($status == 'confirmed') {
                                                $status_color = '#28a745'; 
                                                $text_color = 'white';
                                            } elseif ($status == 'cancelled') {
                                                $status_color = '#dc3545'; 
                                                $text_color = 'white';
                                            } elseif ($status == 'completed') {
                                                $status_color = '#343a40'; 
                                                $text_color = 'white';
                                            } elseif ($status == 'rejected') {
                                                $status_color = '#dc3545'; 
                                                $text_color = 'white';
                                                }
                                    @endphp
                                <div style="color: {{ $status_color }};">
                                    {{ ucfirst($status) }}
                                </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info btn-sm mb-1">View</a>
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @if (trim($booking->status) == 'pending') 
                                        <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="btn btn-success btn-sm mb-1" onclick="return confirm('Are you sure you want to CONFIRM this booking?')">Confirm</button>
                                        </form>

                                        <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to REJECT this booking?')">Reject</button>
                                        </form>
                                    @elseif (trim($booking->status) == 'confirmed') 
                                        <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="btn btn-primary btn-sm mb-1" onclick="return confirm('Mark this booking as COMPLETED?')">Complete</button>
                                        </form>
                                        
                                        <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn btn-warning btn-sm mb-1" onclick="return confirm('Are you sure you want to CANCEL this confirmed booking?')">Cancel</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No bookings found.</td>
                            </tr>
                        @endforelse  
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    #bookingsTable th:nth-child(7), 
    #bookingsTable td:nth-child(7) { 
        min-width: 100px !important; 
        white-space: nowrap !important; 
    }

    #bookingsTable th:nth-child(8),
    #bookingsTable td:nth-child(8) { 
        min-width: 150px !important; 
    } 
</style>