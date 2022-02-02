<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use DB;
class ApiCategoriesController extends Controller
{
      public function getcategory(){
            $category =  DB::table('category')
            ->select('name')
            ->get();

            return response()->json(['Category' => $category]);
      }

      public function getsubcategory($category){
            $subcategory =  DB::table('sub_category')
            ->leftJoin('category','category.id','=','sub_category.category_id')
            ->select('sub_category.name','sub_category.category_id')
            ->where('sub_category.category_id',$category)
            ->get();

            return response()->json(['Sub Category' => $subcategory]);
      }


}
