<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function products(){
        return view('dashboard/products');
    }

    public function accounts(){
        return view('dashboard/accounts');
    }
}
