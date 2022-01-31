<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use DB;
class ApiOrdersController extends Controller
{
  //**************************INSERT**************************//
public function insertorder(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([

            'user_id'=> 'required',
            'status'=> 'required',
            'ref_no'=> 'required',
            'message' => 'nullable',
            'customer' => 'nullable',
            'address' => 'nullable',
            'contact' => 'nullable',
            'scid' => 'nullable',
            'scid_image' => 'nullable',
            'prescription_image' => 'nullable',
            'cashier' => 'nullable',
            'delivery_mode' => 'nullable',
            'delivery_fee' => 'nullable',
            'total_items' => 'nullable',
            'vatable_sale' => 'nullable',
            'vat_amount' => 'nullable',
            'vat_exempt' => 'nullable',
            'subtotal' => 'nullable',
            'is_sc' => 'nullable',
            'sc_discount' => 'nullable',
            'other_discount_rate' => 'nullable',
            'other_discount' => 'nullable',
            'amount_due' => 'nullable',
            'is_void'=> 'required',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'


       ]);

       // CREATE PRODUCT
       $insert = DB::table('orders')
       ->insertGetId([
           'user_id'=> $request->user_id,
           'status'=> $request->status,
           'ref_no'=> $request->ref_no,
           'message'=> $request->message,
           'customer'=> $request->customer,
           'address'=> $request->address,
           'contact'=> $request->contact,
           'scid'=> $request->scid,
           'scid_image'=> $request->scid_image,
           'prescription_image'=> $request->prescription_image,
           'cashier'=> $request->cashier,
           'delivery_mode'=> $request->delivery_mode,
           'delivery_fee'=> $request->delivery_fee,
           'total_items'=> $request->total_items,
           'vatable_sale'=> $request->vatable_sale,
           'vat_amount'=> $request->vat_amount,
           'vat_exempt'=> $request->vat_exempt,
           'subtotal'=> $request->subtotal,
           'is_sc'=> $request->is_sc,
           'sc_discount'=> $request->sc_discount,
           'other_discount_rate'=> $request->other_discount_rate,
           'other_discount'=> $request->other_discount,
           'amount_due'=> $request->amount_due,
           'is_void'=> $request->is_void,
           'created_at'=> $request->created_at,
           'updated_at'=> $request->updated_at


       ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Orders Created'],200);
   }

  //**************************UPDATE**************************//
   public function updateorder(Request $request, $id){
          // VALIDATE PRODUCT
          $request->validate([
              'user_id'=> 'required'. $id,
            'status'=> 'required',
            'ref_no'=> 'required',
            'message' => 'nullable',
            'customer' => 'nullable',
            'address' => 'nullable',
            'contact' => 'nullable',
            'scid' => 'nullable',
            'scid_image' => 'nullable',
            'prescription_image' => 'nullable',
            'cashier' => 'nullable',
            'delivery_mode' => 'nullable',
            'delivery_fee' => 'nullable',
            'total_items' => 'nullable',
            'vatable_sale' => 'nullable',
            'vat_amount' => 'nullable',
            'vat_exempt' => 'nullable',
            'subtotal' => 'nullable',
            'is_sc' => 'nullable',
            'sc_discount' => 'nullable',
            'other_discount_rate' => 'nullable',
            'other_discount' => 'nullable',
            'amount_due' => 'nullable',
            'is_void'=> 'required',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'
          ]);

          // UPDATE PRODUCT
          $update = DB::table('orders')
          ->where('id', $request->id)
        ->update([
          'user_id'=> $request->user_id,
          'status'=> $request->status,
          'ref_no'=> $request->ref_no,
          'message'=> $request->message,
          'customer'=> $request->customer,
          'address'=> $request->address,
          'contact'=> $request->contact,
          'scid'=> $request->scid,
          'scid_image'=> $request->scid_image,
          'prescription_image'=> $request->prescription_image,
          'cashier'=> $request->cashier,
          'delivery_mode'=> $request->delivery_mode,
          'delivery_fee'=> $request->delivery_fee,
          'total_items'=> $request->total_items,
          'vatable_sale'=> $request->vatable_sale,
          'vat_amount'=> $request->vat_amount,
          'vat_exempt'=> $request->vat_exempt,
          'subtotal'=> $request->subtotal,
          'is_sc'=> $request->is_sc,
          'sc_discount'=> $request->sc_discount,
          'other_discount_rate'=> $request->other_discount_rate,
          'other_discount'=> $request->other_discount,
          'amount_due'=> $request->amount_due,
          'is_void'=> $request->is_void,
          'created_at'=> $request->created_at,
          'updated_at'=> $request->updated_at
           ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Orders Updated'],200);
   }


 

   //**************************SHOW VIEW**************************//
   public function showorder(){
           $fetchedit = DB::table('orders')
           ->select('user_id',
           'status',
           'ref_no',
           'message',
           'customer',
           'address',
           'contact',
           'scid',
           'scid_image',
           'prescription_image',
           'cashier',
           'delivery_mode',
           'delivery_fee',
           'total_items',
           'vatable_sale',
           'vat_amount',
           'vat_exempt',
           'subtotal',
           'is_sc',
           'sc_discount',
           'other_discount_rate',
           'other_discount',
           'amount_due',
           'is_void',
           'created_at',
           'updated_at')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editorder($id){
          $fetchedit = DB::table('orders')
          ->select('user_id',
          'status',
          'ref_no',
          'message',
          'customer',
          'address',
          'contact',
          'scid',
          'scid_image',
          'prescription_image',
          'cashier',
          'delivery_mode',
          'delivery_fee',
          'total_items',
          'vatable_sale',
          'vat_amount',
          'vat_exempt',
          'subtotal',
          'is_sc',
          'sc_discount',
          'other_discount_rate',
          'other_discount',
          'amount_due',
          'is_void',
          'created_at',
          'updated_at')
          ->where('id',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
