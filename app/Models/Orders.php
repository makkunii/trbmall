<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'ref_no',
        'message',
        'customer',
        'address',
        'contact',
        'scid',
        'scid_image',
        'prescription_image',
        'cashier',
        'delivery_mode',
        'delivery_fee',
        'total_items',
        'vatable_sale',
        'vat_amount',
        'vat_exempt',
        'subtotal',
        'is_sc',
        'sc_discount',
        'other_discount_rate',
        'other_discount',
        'amount_due',
        'is_void',
        'created_at',
        'updated_at'
    ];
}
