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
       Product::create([
           'user_id'=> $request->input('user_id'),
           'status'=> $request->input('status'),
           'ref_no'=> $request->input('ref_no'),
           'message'=> $request->input('message'),
           'customer'=> $request->input('customer'),
           'address'=> $request->input('address'),
           'contact'=> $request->input('contact'),
           'scid'=> $request->input('scid'),
           'scid_image'=> $request->input('scid_image'),
           'prescription_image'=> $request->input('prescription_image'),
           'cashier'=> $request->input('cashier'),
           'delivery_mode'=> $request->input('delivery_mode'),
           'delivery_fee'=> $request->input('delivery_fee'),
           'total_items'=> $request->input('total_items'),
           'vatable_sale'=> $request->input('vatable_sale'),
           'vat_amount'=> $request->input('vat_amount'),
           'vat_exempt'=> $request->input('vat_exempt'),
           'subtotal'=> $request->input('subtotal'),
           'is_sc'=> $request->input('is_sc'),
           'sc_discount'=> $request->input('sc_discount'),
           'other_discount_rate'=> $request->input('other_discount_rate'),
           'other_discount'=> $request->input('other_discount'),
           'amount_due'=> $request->input('amount_due'),
           'is_void'=> $request->input('is_void'),
           'created_at'=> $request->input('created_at'),
           'updated_at'=> $request->input('updated_at')


       ]);

       // REDIRECT TO PRODUCT INDEX
       return redirect()->route('index')->with('message', $request->name . ' has been saved.');
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
           Product::where('id', $id)
               ->update([
                'user_id'=> $request->input('user_id'),
                'status'=> $request->input('status'),
                'ref_no'=> $request->input('ref_no'),
                'message'=> $request->input('message'),
                'customer'=> $request->input('customer'),
                'address'=> $request->input('address'),
                'contact'=> $request->input('contact'),
                'scid'=> $request->input('scid'),
                'scid_image'=> $request->input('scid_image'),
                'prescription_image'=> $request->input('prescription_image'),
                'cashier'=> $request->input('cashier'),
                'delivery_mode'=> $request->input('delivery_mode'),
                'delivery_fee'=> $request->input('delivery_fee'),
                'total_items'=> $request->input('total_items'),
                'vatable_sale'=> $request->input('vatable_sale'),
                'vat_amount'=> $request->input('vat_amount'),
                'vat_exempt'=> $request->input('vat_exempt'),
                'subtotal'=> $request->input('subtotal'),
                'is_sc'=> $request->input('is_sc'),
                'sc_discount'=> $request->input('sc_discount'),
                'other_discount_rate'=> $request->input('other_discount_rate'),
                'other_discount'=> $request->input('other_discount'),
                'amount_due'=> $request->input('amount_due'),
                'is_void'=> $request->input('is_void'),
                'created_at'=> $request->input('created_at'),
                'updated_at'=> $request->input('updated_at')
           ]);

       // REDIRECT TO PRODUCT INDEX
       return redirect()->route('index')->with('message', $request->name . ' has been updated.');
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
