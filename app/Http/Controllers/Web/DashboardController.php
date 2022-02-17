<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard/dashboard');
    }
    public function orders()
    {
        return view('dashboard/orders');
    }

}
