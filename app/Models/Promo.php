<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rate',
        'is_active',
        'created_at',
        'expired_at'
    ];

    protected $attributes = [
        'is_active' => 1,
    ];
}
