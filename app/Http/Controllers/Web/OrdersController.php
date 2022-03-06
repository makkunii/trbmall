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
        $vorders = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/showorder'); //call api

        if ($vorders->successful()) // CONDITION IF API ABOVE RETURNED SOME DATA
        {

            $vorder = $vorders['Show'];
            // RETURN THIS PAGE IS SUCCESSFUL // vorder BELOW IS USED TO TRANSFER $vorders ABOVE TO THE BLADENAME SPECIFIED ON RETURN VIEW
            return view('dashboard/orders')->with(compact('vorder'));

        }

        else
        {
        return view('dashboard/orders'); // ERROR HANDLING RETURN THIS PAGE IF QUERY DIDNT RETURN DATA
        }
    }

    public function show_ordered_products(Request $request){

        $id = $request->post('order_id'); //get order_id

        $html = "";
           $showproducts = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/show_ordered_products/'.$id);

                if($showproducts->successful()){
                    $showproduct = $showproducts['ShowProduct'];
                    
                foreach($showproduct as $showproductzz)
                {
                    $promo = $showproductzz['promo'];
                }
                
                $showpromo = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/show_promos'); //call api
                
                $showpromos = $showpromo['ShowPromo'];
                
                $promorate = "";
                
                foreach($showpromos as $showpromoz) //get promo used on ordered products
                {
                    if($promo == $showpromoz['name']) //if promo matched the name
                    {
                        $promorate = $showpromoz['rate']; //get promo rate
                    }
                }
                    
                    $html .= '<table class="table table-bordered">'; //UI table for displaying ordered products
                        $html .= '<thead>
                        <tr>
                          <th>Products</th>
                          <th style="width: 100px">Quantity</th>
                          <th style="width: 100px">Price</th>
                        </tr>
                      </thead>';
                      $html .= '<tbody>';
                      
            
                    $total = 0;
                    foreach($showproduct as $showproductz) //get ordered products to display on table
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
                            $html .= '<td><del style="color:red;">'.$totalprice.'</del><br>'.$totalpromo.'</td>'; //cross out original price and display new price based on promo
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
                    
                    echo $html; //echo html and this will display on the blade
                }
                
            
    }

    
                  

                  public function updatestatus(Request $request)
                  {
              
                      $this->validate($request,[
              
                        'order_idzz'=> 'required', // USE REQUIRED IF FIELD IS REQUIRED ON FORM AND DB
                        'status'=> 'required',
              
                     ]);
              
              
                     $update = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/update_status',[ //call api
              
                      'order_id' => $request->order_idzz, // $request->(); is USED TO CALL INPUTFIELD/SESSION/COOKIES/ETC
                      'status' => $request->status
                  ]);
              
                      if ($update->successful())
                      {
                          return redirect()->back()->with('updatesuccess', 'Status updated');  //redirect to the page and alert will pop up
                      }
              
                      else
                      {
                        return redirect()->back()->with('updatefailed', 'Status failed to update'); //error handling and redirect to the page and alert will pop up
                      }
              
                  }
    
    public function orders_transaction() {
        $torders = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/showordertrans'); //call api

        if ($torders->successful()) // CONDITION IF API ABOVE RETURNED SOME DATA
        {

            $torder = $torders['Show'];
            // RETURN THIS PAGE IS SUCCESSFUL //torder BELOW IS USED TO TRANSFER $torders ABOVE TO THE BLADENAME SPECIFIED ON RETURN VIEW
            return view('dashboard/orders_transaction')->with(compact('torder'));

        }

        else
        {
        return view('dashboard/orders_transaction'); // ERROR HANDLING RETURN THIS PAGE IF QUERY $view DIDNT RETURN DATA
        }
    }

}
