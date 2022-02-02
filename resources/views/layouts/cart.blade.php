@extends('home')
@section('content')
@section('title', 'Cart')

@section('content')
<!-- Page Preloder -->
<div id="preloder">
        <div class="loader"></div>
    </div>

    <br>

     <!-- Categories Section Begin -->
     <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                @include('include.categories')
                <div class="col-lg-9">
                    <div class="hero__search">
                    @include('include.search')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Title Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('public/assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        @if ($message = Session::get('success'))
                        <div class="p-4 mb-3 bg-green-400 rounded">
                            <p class="text-green-800">{{ $message }}</p>
                        </div>
                    @endif
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Title Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ asset('public/assets/img/cart/cart-1.jpg') }}" alt="">
                                        <h5>{{ $item->name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        P{{ $item->price }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div>
                                                <form action="{{ route('cart.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id}}" >
                                                  <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                  class="form-control" /><br>
                                                  <button type="submit" class="btn btn-block btn-danger">update</button>
                                                  </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        P{{ ($item->quantity* $item->price)  }}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="id">
                                            <button class="btn btn-block btn-danger">x</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{route('home')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        {{-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>

                            <li>Total <span>P{{ Cart::getTotal() }}</span></li>

                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
    @endsection
@endsection
