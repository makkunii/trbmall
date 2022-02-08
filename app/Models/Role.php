<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    public const SUPER = 1;
    public const ADMIN = 2;
    public const DOCTOR = 3;
    public const RECEPTIONIST = 4;
    public const PATIENT = 5;

    protected $fillable = [
        'name',
    ];

}
