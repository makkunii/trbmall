<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use DB;
class ApiOrdersController extends Controller
{
  //**************************INSERT**************************//
public function insertorder(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([

        'first_name'=> 'required',
        'last_name'=> 'required',
        'province'=> 'required',
        'city'=> 'required',
        'brgy'=> 'required',
        'phone'=> 'required|string|max:20',
        'email'=> 'required|email',
        'promo'=> 'nullable',
        'subtotal'=>'required',
        'total'=>'required|numeric|between:0,9999999.99',
        'products'=>'required|max:255',
        'quantity'=>'required',
        'status'=>'required'
       ]);
       
       $product_id = $request->products;
       $product_ids = json_decode($product_id);
       
       $product_qty = $request->quantity;
       $product_qtys = json_decode($product_qty);
       
       $subtotal = $request->subtotal;
       $subtotals = json_decode($subtotal);
       
       // CREATE PRODUCT
       $insert = DB::table('orders')
           ->insertGetId([
               'first_name'=> $request->first_name,
               'last_name'=> $request->last_name,
               'province'=> $request->province,
               'city'=> $request->city,
               'brgy'=> $request->brgy,
               'phone'=> $request->phone,
               'email'=> $request->email,
               'promo'=> $request->promo,
               'subtotal'=> 0,
               'total'=> $request->total,
               'products'=> 'Eugene Babaero',
               'quantity'=> 1,
               'status'=>$request->status
    
           ]); 

        $id = DB::table('orders')
        ->select('id')
        ->latest('id')
        ->first();
        
        
        foreach($product_ids as $results => $key)
      {
        $inserts = DB::table('product_orders')
       ->insertGetId([
           'orders_id'=> $id->id,
           'product_id' => $key,
           'quantity' => $product_qtys[$results],
           'subtotal' => $subtotals[$results],
       ]);     
      }
         
       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Orders Created'],200);
   }

  //**************************UPDATE**************************//
   public function updateorder(Request $request, $id){
          // VALIDATE PRODUCT
          $request->validate([
            'first_name'=> 'required'. $id,
            'last_name'=> 'required',
            'province'=> 'required',
            'city'=> 'required',
            'brgy'=> 'required',
            'phone'=> 'required',
            'email'=> 'required',
            'promo'=> 'nullable',
            'total'=>'required',
            'products'=>'required',
            'quantity'=>'required',
            'created_at'=> 'nullable',
            'updated_at'=> 'nullable',
            'status'=>'required'
    
          ]);

          // UPDATE PRODUCT
          $update = DB::table('orders')
          ->where('id', $request->id)
        ->update([
          'first_name'=> $request->first_name,
          'last_name'=> $request->last_name,
          'province'=> $request->province,
          'city'=> $request->city,
          'brgy'=> $request->brgy,
          'phone'=> $request->phone,
          'email'=> $request->email,
          'promo'=> $request->promo,
          'total'=> $request->total,
          'products'=> $request->products,
          'quantity'=> $request->quantity,
          'created_at'=> $request->created_at,
          'updated_at'=> now(),
          'status'=>$request->status

           ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Orders Updated'],200);
   }


 

   //**************************SHOW VIEW**************************//
   public function showorder(){
           $fetchedit = DB::table('orders')
           ->select('id',
           'first_name',
           'last_name',
           'province',
           'city',
           'brgy',
           'phone',
           'email',
           'subtotal',
           'promo',
           'total',
           'products',
           'quantity',
           'created_at',
           'updated_at',
           DB::raw('(CASE WHEN status = 1 THEN "Pending" WHEN status = 2 THEN "COP" WHEN status = 3 THEN "COD" ELSE "Cancelled" END) as status'))
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }
       
   public function show_ordered_products($order_id){
           $fetchedit = DB::table('orders')
           ->leftJoin('product_orders', 'product_orders.orders_id', '=', 'orders.id')
           ->leftJoin('products', 'products.id', '=', 'product_orders.product_id')
           ->where('orders.id', $order_id)
           ->select('orders.id as order_id', 'orders.promo as promo', 'products.name as product_name', 'product_orders.quantity as quantity', 'products.price as orig_price', 'product_orders.subtotal as price')
           ->get();
           return response()->json(['ShowProduct' => $fetchedit], 200);
       }
       
    public function show_promos(){
           $fetchedit = DB::table('promos')
           ->where('is_active', 1)
           ->select('id', 'name', 'rate')
           ->get();
           return response()->json(['ShowPromo' => $fetchedit], 200);
       }
       
    public function update_status(Request $request){
        $request->validate([
            'order_id'=> 'required',
            'status'=> 'required',
          ]);
          
           $update = DB::table('orders')
          ->where('id', $request->order_id)
          ->update([
          'status'=> $request->status,
           ]);
           
           return response()->json(['Success' => 'Orders Updated'],200);
       }

  //**************************EDIT VIEW**************************//
  public function editorder($id){
          $fetchedit = DB::table('orders')
          ->select('first_name',
          'last_name',
          'province',
          'city',
          'brgy',
          'phone',
          'email',
          'promo',
          'total',
          'products',
          'quantity',
          'created_at',
          'updated_at',
          'status')
          ->where('id',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
