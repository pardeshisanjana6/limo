<x-mail::message>
Booking Confirmed!

Dear {{ $booking->customer_name ?? (optional($booking->user)->name ?? 'Customer') }},

We are excited to inform you that your booking **{{ $booking->id }}** has been officially **CONFIRMED**!

**Booking Details:**
* **Vehicle:** {{ optional(optional($booking->vehicle)->brand)->name ?? 'N/A' }} - {{ optional($booking->vehicle)->vehicle_title ?? 'N/A' }} ({{ optional($booking->vehicle)->model_year ?? 'N/A' }})
* **Pickup Date:** {{ \Carbon\Carbon::parse($booking->pickup_date)->format('M d, Y') }}
* **Drop-off Date:** {{ \Carbon\Carbon::parse($booking->dropoff_date)->format('M d, Y') }}
* **Pickup Time:** {{ \Carbon\Carbon::parse($booking->pickup_time)->format('h:i A') }}
* **Total Amount:** ₹{{ number_format($booking->total_amount, 2) }}
* **Customer Mobile:** {{ $booking->customer_mobile ?? 'N/A' }}
* **Customer Address:** {{ $booking->customer_address ?? 'N/A' }}

Please prepare for your exciting trip! If you have any questions, feel free to contact us.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>