<?php



namespace App\Http\Controllers;



use App\Models\Product;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;



class HomeController extends Controller

{

    public function index()

    {

        $products = Product::all();



        return view('layouts/products', compact('products'));

    }



    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */



}

