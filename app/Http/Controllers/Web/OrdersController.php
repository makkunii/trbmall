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

    public function show_ordered_products(Request $request){

        $id = $this->validate($request,['id' => 'required']);

        if($id){
        
           $showproducts = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/show_ordered_products/'.$id['order_id']);

                if($showproducts->successful()){

                    $showproduct = $showproducts['ShowProduct'];

                    return view('dashboard/orders')->with(compact('showproduct'));
                }
                else{
                    return view('dashboard/orders');
                }
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
