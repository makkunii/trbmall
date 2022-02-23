<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class OrdersController extends Controller
{
    public function orders()
    {
        $vorders = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/showorder');

        if ($vorders->successful())
        {

            $vorder = $vorders['Show'];
            return view('dashboard/orders')->with(compact('vorder'));

        }

        else
        {
        return view('dashboard/orders');
        }
    }

    
    public function editname(Request $request) {
        $order_id = $this->validate($request, ['order_id' => 'required']);
                                    // ->get IF DISPLAYING DATA	// .$id['id'] CAME FROM THE VARIABLE ABOVE
        $view = Http::accept('application/json')->get('https:/.../api/.../edit/'.$id['id']);
        
        if($view->successful()) {
            
            $info = $view['ShowProduct']; 
            
            if($info['order_id'] = $order_id['order_id']) {
                return view('bladename')->with(compact('info'));
            } else {
                return view('bladename'); 
            }
        } else {
            return view('bladename'); 
        }
    }

    
    public function orders_transaction() {
        $torders = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/showordertrans');

        if ($torders->successful())
        {

            $torder = $torders['Show'];
            return view('dashboard/orders_transaction')->with(compact('torder'));

        }

        else
        {
        return view('dashboard/orders_transaction');
        }
    }

}
