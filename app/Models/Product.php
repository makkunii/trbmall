<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tbl_product';
    protected $fillable = [
           'name',
           'description',
           'price' ,
           'category',
           'sub-category',
           'weight',
           'length',
           'height',
           'status'
    ];
}
