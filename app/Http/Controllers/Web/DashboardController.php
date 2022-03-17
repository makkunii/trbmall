<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        if (session()->has('id')) {
            return view('dashboard/dashboard');
        } else {
            return redirect('login');
        }
    }

}
