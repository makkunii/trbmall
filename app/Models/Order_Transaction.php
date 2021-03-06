<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_id',
        'created_at',
        'updated_at',
        'created_by',
        'status'
    ];
}
