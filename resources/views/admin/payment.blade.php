@extends('admin.adminlayout')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Payment History</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Vehicle</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->user->name ?? 'N/A' }}</td>
                            <td>{{ optional(optional($booking->vehicle)->brand)->name ?? 'N/A' }} - {{ optional($booking->vehicle)->vehicle_title ?? 'N/A' }}</td>
                            <td>₹{{ number_format($booking->total_amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y') }}</td>
                            <!-- <td>{{ $booking->payment_status }}</td> -->
                             <td>
                                @if ($booking->payment_status === 'paid' && $booking->status === 'cancelled')
                                    <form action="{{ route('admin.bookings.refund', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to send this refund?');">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="fas fa-undo"></i> Send Refund
                                        </button>
                                    </form>
                                @else
                                    {{ ucfirst($booking->payment_status) }}
                                @endif
                            </td>

                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection