<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class SubCategoryController extends Controller
{
    public function subcategory()
    {
        return view('dashboard/subcategory');
    }
}
