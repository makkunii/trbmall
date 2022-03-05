<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

// we are using a package here

class CartController extends Controller

{
    // public function saveJson($request)
    //     {
    //         $data = json_decode($request->getContent());

    //     }

    //here it calls the cartlist
    public function cartList()

    {

        $cartItems = \Cart::getContent();

        // dd($cartItems);

        return view('layouts/cart', compact('cartItems'));

    }

   // here it adds the selected item to the cart
    public function addToCart(Request $request)

    {

        \Cart::add([

            'id' => $request->id,

            'name' => $request->name,

            'price' => $request->price,

            'quantity' => $request->quantity,

        ]);

        session()->flash('success', 'Product is Added to Cart Successfully !');



        return redirect()->route('home');

    }

 // here it updates the cart

    public function updateCart(Request $request)

    {

        \Cart::update(

            $request->id,

            [

                'quantity' => [

                    'relative' => false,

                    'value' => $request->quantity

                ],

            ]

        );



        session()->flash('success', 'Item Cart is Updated Successfully !');



        return redirect()->route('cart.list');

    }

// here when we remove items to the cart

    public function removeCart(Request $request)

    {

        \Cart::remove($request->id);

        session()->flash('success', 'Item Cart Remove Successfully !');



        return redirect()->route('cart.list');

    }

// clear all cart

    public function clearAllCart()

    {

        \Cart::clear();



        session()->flash('success', 'All Item Cart Clear Successfully !');



        return redirect()->route('cart.list');

    }

}

