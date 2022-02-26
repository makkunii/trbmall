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

        $id = $request->post('order_id');

        $html = "";
           $showproducts = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/show_ordered_products/'.$id);

                if($showproducts->successful()){
                    $showproduct = $showproducts['ShowProduct'];
                    $html .= '<table class="table table-bordered">';
                        $html .= '<thead>
                        <tr>
                          <th>Products</th>
                          <th style="width: 100px">Quantity</th>
                          <th style="width: 100px">Price</th>
                        </tr>
                      </thead>';
                      $html .= '<tbody>';
                      
                      
                    $total = 0;
                    foreach($showproduct as $showproductz)
                    {  
                        $totalprice = $showproductz['price'] * $showproductz['quantity'];
                        
                        $html .= '<tr>';
                        $html .= '<td>'.$showproductz['product_name'].'</td>';
                        $html .= '<td>'.$showproductz['quantity'].'</td>';
                        $html .= '<td>'.$totalprice.'</td>';
                        $html .= '</tr>';
                        
                        // $html .= $showproductz['product_name'];
                        // $html .= $showproductz['quantity'];
                        
                        $total+= $totalprice;
                    }
                    $html .= '<tr><td colspan="2">Total:</td><td>'.$total.'</td></tr>';
                    $html .= '</tbody>';
                    $html .= '</table>';

                    echo $html;
                }
                else{
                    $html .= $showproducts;
                    
                    echo $html;
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
