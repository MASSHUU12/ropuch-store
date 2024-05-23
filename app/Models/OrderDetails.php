<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'buyer_name',
        'buyer_email',
        'delivery_address',
        'delivery_city',
        'delivery_zip',
        'delivery_country',
    ];
}
