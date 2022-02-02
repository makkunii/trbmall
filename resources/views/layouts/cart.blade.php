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
                        <h2 class="text-dark">Shopping Cart</h2>
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
                                    <th></th>
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
                                 <td>
                                  <input type="checkbox" class="checkit">
                                </td>
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
                                <td class="shoping__cart__total Total">
                                    P<div class="ItemTotal" style="float:right">{{ ($item->quantity* $item->price)  }}</div>
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

                            <li>Total <span>P<div style="float:right" id="TotalAmt"></div></span></li>

                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('.checkit').change(function () {
    calculateTotals();
}).change();


// Calculate the total amount from selected items only
function calculateTotals() {
    var Sum = 0;
    // iterate through each td based on class and add the values
    $(".Total").each(function () {
        //Check if the checkbox is checked
        if ($(this).closest('tr').find('.checkit').is(':checked')) {
            var value = $('.ItemTotal', this).text();
            // add only if the value is number
            if (!isNaN(value) && value.length != 0) {
                Sum += parseFloat(value);
            }
        }
    });
    $('#TotalAmt').text(Sum.toFixed(2));
};

            </script>
    </section>
    <!-- Shoping Cart Section End -->
    @endsection
@endsection
