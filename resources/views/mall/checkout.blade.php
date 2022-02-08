@extends('home')
@section('content')
@section('title', 'Checkout')

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
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Title Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" placeholder="Enter first name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" placeholder="Enter last name">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add">
                            </div>
                            <div class="checkout__input">
                                <p>Province<span>*</span></p>
                                <select class="combobox" name="province" id="province">
                                <option selected disabled>Select province</option>
                                <option value="#"></option>
                                </select>
                            </div><br>
                            <div class="checkout__input"><br><br>
                                <p>City<span>*</span></p>
                                <select class="combobox" name="city" id="city">
                                <option selected disabled>Select city</option>
                                <option value="#"></option>
                                </select>
                            </div><br>
                            <div class="checkout__input"><br><br>
                                <p>Barangay<span>*</span></p>
                                <select class="combobox" name="barangay" id="barangay">
                                <option selected disabled>Select barangay</option>
                                <option value="#"></option>
                                </select>
                            </div><br><br><br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end -->
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <form action="" method="POST">
                                    @csrf
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>

                                <ul>

                                    @foreach(Session::get('data')['product_id'] as $index => $product)
                                    <li>
                                        {{ Session::get('data')['product_name'][$index] }} - {{ Session::get('data')['product_qty'][$index] }}
                                    <span>P{{ Session::get('data')['product_qty'][$index]*Session::get('data')['product_price'][$index] }} </span>

                                    <input type="hidden" name="product_id[]" class="product-id" id="product-id" value=" {{ Session::get('data')['product_id'][$index] }}">
                                    <input type="hidden" name="product_name[]" class="product-name" id="product-name" value=" {{ Session::get('data')['product_name'][$index] }}">
                                    <input type="hidden" name="product_price[]" class="product-price" id="product-price" value=" {{ Session::get('data')['product_price'][$index] }}">
                                    <input type="hidden" name="product_qty[]" class="product-qty" id="product-qty" value=" {{ Session::get('data')['product_qty'][$index] }}">
                                    </li>
                                     @endforeach






                                </ul>



                                        <div class="shoping__discount">
                                        <div class="checkout__input">
                                            <form action="#">
                                            <div class="row">
                                                <input type="text" placeholder="Enter promo code">
                                                <button type="submit" class="site-btn" style="font-size: 10px;">ADD PROMO</button>
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                <div class="checkout__order__subtotal">Subtotal <span>P<div style="float:right" id="TotalAmt"></div></span></div>

                                <div class="checkout__order__total">Promo/Discount <span style="color: black;">₱100.00</span></div>
                                <div class="checkout__order__total">Total <span>₱189.00</span></div>

                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
    $(document).ready(function() {
        const prodprice = [];
        const prodqty = [];
        const product = 0;

        $('input[name^="prod_price"]').each(function()
        {
            prodprice.push($(this).val());
        });

        $('input[name^="prod_qty"]').each(function()
        {
            prodqty.push($(this).val());
        });
        for(var i=0; i< prodprice.length; i++) {
        sum += prodprice[i]*prodqty[i];
}
$('#TotalAmt').text(sum.toFixed(2));

});
      </script>
    <!-- Checkout Section End -->
@endsection
