<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use DB;
class ApiLocationController extends Controller
{
      public function getprovince(){
            $province =  DB::table('refprovince')
            
            ->select('id','provDesc')
            ->get();
      
            return response()->json(['Provinces' => $province]);
      }
       
      public function getcity($province){
            $city =  DB::table('refcitymun')
            ->leftJoin('refprovince','refprovince.provCode','=','refcitymun.provCode')
            ->where('refprovince.provCode',$province)
            ->select('id','citymunDesc')         
            ->get();
       
            return response()->json(['City/Municipality' => $city]);
      }
       
      public function getbrgy($city,$province){
            $brgy =  DB::table('refbrgy')
            ->leftJoin('refcitymun','refcitymun.citymunCode','=','refbrgy.citymunCode')
            ->leftJoin('refprovince','refprovince.provCode','=','refcitymun.provCode')
            ->where('refcitymun.citymunDesc',$city)
            ->where('refprovince.provDesc',$province)
            ->select('id','brgyDesc')
            ->get();
       
            return response()->json(['barangay' => $brgy]);
      }
} 
