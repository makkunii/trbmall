<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,
           'email',
           'email_verified_at',
           'is_admin',
           'is_active',
           'firs_name',
           'last_name',
           'contact',
           'scid',
           'remember_token',
           'created_at',
           'updated_at'
    ];

    protected $attributes = [
        'is_active' => 1,
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
