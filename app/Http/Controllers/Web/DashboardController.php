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
        }

        else if (session()->has('role_id' == 0)){
            return redirect('login');
        }
        
         else {
            return redirect('login');
        }
    }

}
