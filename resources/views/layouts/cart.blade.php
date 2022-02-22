@extends('home')
@section('content')
@section('title', 'Cart')
<meta name="csrf-often" content="{{ csrf_token() }}">
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
    <section class="breadcrumb-section set-bg" data-setbg="public/assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
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
                                  <input type="checkbox" class="checkit" name="prodid[]" value="{{ $item->name }}">
                                  <input type="hidden" name="prod_id[]" class="prod-id" value="{{ $item->id }}">
                                </td>

                                <td class="shoping__cart__item">
                                    <img src="public/assets/img/cart/cart-1.jpg" alt="">
                                     <h5>{{ $item->name }}</h5>
                                     <input type="hidden" name="prod_name[]" class="prod-name" value="{{ $item->name }}">
                                </td>
                                <td class="shoping__cart__price">
                                    <span class="price">{{ $item->price }}</span>
                                    <input type="hidden" name="prod_price[]" class="prod-price" value="{{ $item->price }}">

                                </td>

                                <td class="shoping__cart__quantity">
                                    <div>
                                        <div>
                                            <form action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                            <input type="hidden" name="id" value="{{ $item->id}}" >
                                              <input type="number" name="quantity" class="quantity" value="{{ $item->quantity }}">
                                              <input type="hidden" name="prod_qty[]" class="prod-qty" value="{{ $item->quantity }}" >

                                             <br>
                                             <br>
                                              <button type="submit" class="btn btn-block btn-danger">update</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total Total">
                                    <div class="ItemTotal" class="perItemTotal">{{ ($item->quantity* $item->price)  }}</div>

                                    <td  style="width:10%; " class="shoping__cart__item__close">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="id">
                                            <button class="btn btn-block btn-danger">x</button>
                                        </form>
                                    </td>
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
                    <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    {{-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Upadate Cart</a> --}}
                </div>
            </div>
            <div class="col-lg-6">
                {{-- <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-6">
            <div class="shoping__checkout">
                <h5>Cart Total</h5>
                <ul>
                    <li>Total <span>P<div style="float:right" id="TotalAmt"></div></span></li>
                    <li></li>
                </ul>

                <input type="submit" class="btn btn-block btn-danger btn-lg cartCheckout" value="CHECKOUT">
            </div>
        </div>
    </div>





        </div>
    </form>


<script>
$(document).ready(function(){
    $('.cartCheckout').on('click', function(e)
    {
        e.preventDefault();

        const prodid = [];
        const prod_id = [];
        const prod_name = [];
        const prod_price = [];
        const prod_qty = [];


        $('.checkit').each(function()
        {
            if($(this).is(":checked"))
            {
                prodid.push($(this).val());
            }
        });
        $('input[name^="prod_id"]').each(function()
        {
            prod_id.push($(this).val());
        });
        $('input[name^="prod_name"]').each(function()
        {
            prod_name.push($(this).val());
        });

        $('input[name^="prod_price"]').each(function()
        {
            prod_price.push($(this).val());
        });

        $('input[name^="prod_qty"]').each(function()
        {
            prod_qty.push($(this).val());
        });



        $.ajax({
            url: '/save_data',
            type: 'POST',
            dataType : 'json',
            data: {
                _token: '{{csrf_token()}}',
                prodid : prodid,
                prod_id : prod_id,
                prod_name : prod_name,
                prod_price : prod_price,
                prod_qty : prod_qty
            },
            success: function (response) {
                if(response.success) {
                    document.location = '/mall/checkout';
                } else {
                    console.log(data);
                }

    },
    error:function(response) {
        console.log(data);
    }

        });



    });
});


$('.checkit').change(function () {
    calculateTotals();
}).change();

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
function getData() {

};



            </script>
    </section>
    <!-- Shoping Cart Section End -->
    @endsection
@endsection
