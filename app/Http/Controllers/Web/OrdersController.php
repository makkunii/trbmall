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
                    
                foreach($showproduct as $showproductzz)
                {
                    $promo = $showproductzz['promo'];
                }
                
                $showpromo = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/show_promos');
                
                $showpromos = $showpromo['ShowPromo'];
                
                $promorate = "";
                
                foreach($showpromos as $showpromoz)
                {
                    if($promo == $showpromoz['name'])
                    {
                        $promorate = $showpromoz['rate'];
                    }
                }
                    
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
                        if($showproductz['promo'] == "")
                        {
                            $html .= '<td>'.$totalprice.'</td>';
                            $total+= $totalprice;
                        }
                        else
                        {
                            $totalpromo = $totalprice * $promorate;
                            $html .= '<td><del style="color:red;">'.$totalprice.'</del><br>'.$totalpromo.'</td>';
                            $total+= $totalpromo;
                        }
                        $html .= '</tr>';
                        
                        
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

    
                  

                  public function updatestatus(Request $request)
                  {
              
                      $this->validate($request,[
              
                        'order_idzz'=> 'required',
                        'status'=> 'required',
              
                     ]);
              
              
                     $update = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/update_status',[
              
                      'order_id' => $request->order_idzz,
                      'status' => $request->status
                  ]);
              
                      if ($update->successful())
                      {
                          return redirect()->back()->with('updatesuccess', 'Status updated');
                      }
              
                      else
                      {
                        return redirect()->back()->with('updatefailed', 'Status failed to update');
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
