<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tbl_product';
    protected $fillable = [
        'name',
        'category_id',
        'tax_id',
        'generic_name',
        'drug_class',
        'description',
        'price',
        'stock',
        'measurement',
        'is_prescription',
        'is_available',
        'is_active',
        'image'
    ];
}
