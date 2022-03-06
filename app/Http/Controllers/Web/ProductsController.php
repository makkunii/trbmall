<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
     //PRODUCT

     public function products(Request $request)
     {
 
         $vproduct = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/products'); //call api
 
         if ($vproduct->successful()) // CONDITION IF API ABOVE RETURNED SOME DATA
         {
 
             $productdata = $vproduct['Show'];
        // RETURN THIS PAGE IS SUCCESSFUL // productdata BELOW IS USED TO TRANSFER $vproduct ABOVE TO THE BLADENAME SPECIFIED ON RETURN VIEW
             return view('dashboard/products')->with(compact('productdata'));
 
         }
 
         else
         {
 
             return view('dashboard/dashboard'); // ERROR HANDLING RETURN THIS PAGE IF QUERY DIDNT RETURN DATA
 
         }
 
     }
 
     public function insertproduct(Request $request) {
 
             $this->validate($request,[
                 'name' => 'required', // USE REQUIRED IF FIELD IS REQUIRED ON FORM AND DB
                 'description' => 'required',
                 'price' => 'required',
                 'subcategory_id' => 'required',
                 'weight' => 'nullable', // USE NULLABLE IF FIELD IS NOT REQUIRED ON FORM AND DB
                 'length' => 'nullable',
                 'height' => 'nullable',
                 'status' => 'required'
             ]);
 
             $insert = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/products/insert',[ //call api
                 'name' => $request->name, // $request->(); is USED TO CALL INPUTFIELD/SESSION/COOKIES/ETC
                 'description' => $request->description,
                 'price' => $request->price,
                 'subcategory_id' => $request->subcategory_id,
                 'weight' => $request->weight,
                 'length' => $request->length,
                 'height' => $request->height,
                 'status' => $request->status
             ]);
 
             if($insert->successful()) {
 
                 return redirect()->back()->with('insertsuccess', 'Product saved'); //redirect to the page and alert will pop up
 
             } else {
                 return redirect()->back()->with('insertfailed', 'Product failed to save'); //error handling and redirect to the page and alert will pop up
             }
     }
 
     public function updateproduct(Request $request)
     {
 
         $this->validate($request,[
 
             'id' => 'required', // USE REQUIRED IF FIELD IS REQUIRED ON FORM AND DB
             'name' => 'required',
             'description' => 'required',
             'price' => 'required',
             'subcategory_id' => 'required',
             'weight' => 'required',
             'length' => 'required',
             'height' => 'required',
             'status'  => 'required'
 
        ]);
 
        $id = $request->input('id');
 
        $update = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/products/update',[ //call api
 
         'id' => $request->id, // $request->(); is USED TO CALL INPUTFIELD/SESSION/COOKIES/ETC
         'name' => $request->name,
         'description' => $request->description,
         'price' => $request->price,
         'subcategory_id' => $request->subcategory_id,
         'weight' => $request->weight,
         'length' => $request->length,
         'height' => $request->height,
         'status' => $request->status
     ]);
 
         if ($update->successful())
         {
             return redirect()->back()->with('updatesuccess', 'Product updated'); //redirect to the page and alert will pop up
         }
 
         else
         {
             return redirect()->back()->with('updatefailed', 'Product failed to update'); //error handling and redirect to the page and alert will pop up
         }
 
     }
}
