<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'customer',
        'total_amount',
        'guests',
        'status'
    ];

    public function date(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst(Carbon::parse($value)
                ->locale('fr')
                ->isoFormat('dddd, D MMMM YYYY • HH:mm'))
        );
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
