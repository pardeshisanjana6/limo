<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_title',
        'brand_id',
        'vehicle_overview',
        'price_per_day',
        'fuel_type',
        'model_year',
        'seating_capacity',
        'image_path',
        'accessories',
    ];

    protected $casts = [
        'accessories' => 'array', // Cast accessories to an array
    ];

    // Define relationship with Brand model
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}