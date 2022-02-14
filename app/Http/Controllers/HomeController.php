<?php



namespace App\Http\Controllers;



use App\Models\Product;
use App\Models\Checkout;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller

{

    public function index()

    {

        $products = Product::all();



        return view('layouts/products', compact('products'));

    }
 
    public function save_data(Request $request)

    {

        $checked_array = $request->prodid;
        foreach($request->prod_name as $key => $value) {
            if(in_array($request->prod_name[$key], $checked_array)) {
                $product = new Checkout;

                $product->name = $request->prod_name[$key];
                $product->price = $request->prod_price[$key];
                $product->quantity = $request->prod_qty[$key];

                $product_id[] =  $request->prod_id[$key];
                $product_name[] =  $request->prod_name[$key];
                $product_price[] = $request->prod_price[$key];
                $product_quantity[] = $request->prod_qty[$key];


                session(['data' => [
                    "product_id" => $product_id,
                    "product_name" => $product_name,
                    "product_price" => $product_price,
                    "product_qty" =>$product_quantity


                   ]]);

                // $product_id= $request->prod_id[$key];
                // $product_name = $request->prod_name[$key];
                // $product_price = $request->prod_price[$key];
                // $product_quantity = $request->prod_qty[$key];

                // \Cart::remove($request->prod_id[$key]);

                // session()->flash('success', 'Item Cart Remove Successfully !');

                // $product->save();

            }

        }

        return response()->json(['success' => 'Data Inserted']);

    }



    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */



}

