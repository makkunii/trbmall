<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use DB;
class ApiRoleController extends Controller
{
  //**************************INSERT**************************//
public function insertrole(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([
           'name' => 'required',
           'description' => 'required',
           'status' => 'required',
           'created_by' => 'required',
           'created_at' => 'required'

       ]);

       // CREATE PRODUCT
       $insert = DB::table('Role')
       ->insertGetId([
           'name' => $request->name,
           'description' => $request->description,
           'status' => $request->status,
           'created_by' => $request->created_by,
           'created_at' => $request->created_at

       ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Role Created'],200);
   }

  //**************************UPDATE**************************//
   public function updaterole(Request $request){
          // VALIDATE PRODUCT
          $request->validate([
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'created_by' => 'required',
            'created_at' => 'required'
          ]);

          // UPDATE PRODUCT
          $update = DB::table('Role')
          ->where('id', $request->id)
                ->update([
                    'id' =>$request->id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => $request->status,
                    'created_by' => $request->created_by,
                    'created_at' => $request->created_at


           ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Promo Updated'],200);
   }


   public function disablerole(Request $request){
       $request->validate([
           'status' => 'required'
       ]); // this is validation for api before update

       //update in database
       $update = DB::table('Role')
       ->where('id', $request->id)
       ->update([
           'status' => $request->status
       ]);
       return response()->json(['Success' => 'Role Disable'],200);

}

   //**************************SHOW VIEW**************************//
   public function showrole(){
           $fetchedit = DB::table('Role')
           ->select('id','name','status','created_by','created_at')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editrole($id){
          $fetchedit = DB::table('Role')
          ->select('id','name','status','created_by','created_at')
          ->where('id',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }

        //**************************CHECK VIEW**************************//
   public function checkrole(){
    $fetchedit = DB::table('Role')
           ->select('id','name','status','created_by','created_at')
           ->get();
           return response()->json(['Check' => $fetchedit], 200);
}
}
