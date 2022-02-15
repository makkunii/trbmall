<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'province',
        'city',
        'brgy',
        'phone',
        'email',
        'promo',
        'total',
        'created_at',
        'updated_at'
    ];
}
