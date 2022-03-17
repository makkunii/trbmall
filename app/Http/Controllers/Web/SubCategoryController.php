<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class SubCategoryController extends Controller
{

    //show sub category
    public function subcategory(Request $request)
    {
        if(!session()->has('id')) {
            return view('login');
        } else {

        $token = $request->cookie('token');
        
        $vcategory = Http::accept('application/json')->withToken($token)->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory/view/vcategory'); //call api for category

        if ($vcategory->successful()) // CONDITION IF API ABOVE RETURNED SOME DATA
        {
            
            $vsubcategory = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory'); //call api for sub category

            

            if ($vsubcategory->successful()) // CONDITION IF API ABOVE RETURNED SOME DATA
        {
            $vcategorydata = $vcategory['ShowCategory'];
            $subcategorydata = $vsubcategory['Show'];
            // RETURN THIS PAGE IS SUCCESSFUL // vcategorydata and subcategorydata BELOW IS USED TO TRANSFER $vcategory and vsubcategory ABOVE TO THE BLADENAME SPECIFIED ON RETURN VIEW
            return view('dashboard/subcategory')->with(compact('vcategorydata','subcategorydata'));

        }

        else
        {
            return view('dashboard/dashboard'); // ERROR HANDLING RETURN THIS PAGE IF QUERY DIDNT RETURN DATA
        }

        }

        else
        {
            return view('dashboard/dashboard'); // ERROR HANDLING RETURN THIS PAGE IF QUERY DIDNT RETURN DATA
        }
    }
    }

    //show category on select
    public function vcategory(Request $request)
    {
        if(!session()->has('id')) {
            return view('login');
        } else {
            $token = $request->cookie('token');
            
        $vcategory = Http::accept('application/json')->withToken($token)->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory/view/vcategory'); //call api

        if ($vcategory->successful()) // CONDITION IF API ABOVE RETURNED SOME DATA
        {

            $vcategorydata = $vcategory['ShowCategory'];
            // RETURN THIS PAGE IS SUCCESSFUL // vcategorydata a BELOW IS USED TO TRANSFER $vcategory ABOVE TO THE BLADENAME SPECIFIED ON RETURN VIEW
            return view('dashboard/subcategory')->with(compact('vcategorydata'));

        }

        else
        {
            return view('dashboard/dashboard'); // ERROR HANDLING RETURN THIS PAGE IF QUERY DIDNT RETURN DATA
        }
    }
    }

    public function insertsubcategory(Request $request) {
        if(!session()->has('id')) {
            return view('login');
        } else {


        $this->validate($request,[
            'name' => 'required', // USE REQUIRED IF FIELD IS REQUIRED ON FORM AND DB
            'category_id' => 'required',
            'is_active' => 'required'
        ]);
        $token = $request->cookie('token');
        $insert = Http::accept('application/json')->withToken($token)->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory/insert',[ //call api
            'name' => $request->name, // $request->(); is USED TO CALL INPUTFIELD/SESSION/COOKIES/ETC
            'category_id' => $request->category_id,
            'is_active' => $request->is_active
        ]);

        if($insert->successful()) {

            return redirect()->back()->with('insertsuccess', 'SubCategory saved'); //redirect to the page and alert will pop up

        } else {
            return redirect()->back()->with('insertfailed', 'SubCategory failed to save'); //error handling and redirect to the page and alert will pop up
        }
    }
    }

    public function updatesubcategory(Request $request)
    {
        if(!session()->has('id')) {
            return view('login');
        } else {


        $this->validate($request,[

            'id' => 'required', // USE REQUIRED IF FIELD IS REQUIRED ON FORM AND DB
            'name' => 'required',
            'category_id' => 'required',
            'is_active' => 'required'

       ]);

       $id = $request->input('id');
       $token = $request->cookie('token');
       
       $update = Http::accept('application/json')->withToken($token)->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory/update',[ //call api

        'id' => $request->id, // $request->(); is USED TO CALL INPUTFIELD/SESSION/COOKIES/ETC
        'name' => $request->name,
        'category_id' => $request->category_id,
        'is_active' => $request->is_active
    ]);

        if ($update->successful())
        {
            return redirect()->back()->with('updatesuccess', 'SubCategory updated'); //redirect to the page and alert will pop up
        }

        else
        {
            return redirect()->back()->with('updatefailed', 'SubCategory failed to update'); //error handling and redirect to the page and alert will pop up
        }
    }

    }


} //end
