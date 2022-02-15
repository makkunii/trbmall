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
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('/assets/img/breadcrumb.jpg') }}">
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

                    <div class="row">
                        
                        <div class="col-lg-8 col-md-6">
                            <form method="POST">
                                @csrf
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
                                <select class="combobox province" name="province" id="province" aria-label="Default select example">
                                <option selected disabled>Select province</option>
                                <?php foreach ($province as $prov) { ?>
                                <option value="<?php echo $prov['provDesc'];?>"><?php echo $prov['provDesc'];?></option>
                                <?php } ?>
                                </select>
                            </div><br>
                            <div class="checkout__input"><br><br>
                                <p>City<span>*</span></p>
                                <select class="combobox city" name="city" id="city" aria-label="Default select example">
                                    <option value="null" selected disabled> Select Province first </option>
                                </select>
                            </div><br>
                            <div class="checkout__input"><br><br>
                                <p>Barangay<span>*</span></p>
                                <select class="combobox brgy" name="brgy" id="brgy" aria-label="Default select example">
                                <option value="null" selected disabled> Select City/Municipality first </option>
                                </select>
                            </div><br><br><br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" placeholder="Enter Phone Number">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> <!-- end -->
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">

                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>

                                <ul>

                                    @foreach(Session::get('data')['product_id'] as $index => $product)
                                    <li>
                                        {{ Session::get('data')['product_name'][$index] }} - {{ Session::get('data')['product_qty'][$index] }}
                                    <span>₱{{ Session::get('data')['product_qty'][$index]*Session::get('data')['product_price'][$index] }} </span>

                                    <input type="hidden" name="product_id[]" class="product-id" id="product-id" value="{{ Session::get('data')['product_id'][$index] }}">
                                    <input type="hidden" name="product_name[]" class="product-name" id="product-name" value="{{ Session::get('data')['product_name'][$index] }}">
                                    <input type="hidden" name="product_price[]" class="product-price" id="product-price" value="{{ Session::get('data')['product_price'][$index] }}">
                                    <input type="hidden" name="product_qty[]" class="product-qty" id="product-qty" value="{{ Session::get('data')['product_qty'][$index] }}">
                                    <input type="hidden" name="product_subtotal[]" class="product-subtotal" id="product-subtotal"
                                    value="{{ Session::get('data')['product_qty'][$index]*Session::get('data')['product_price'][$index] }}">
                                    </li>
                                     @endforeach
                                </ul>



                                        <div class="shoping__discount">
                                        <div class="checkout__input">
                                            <form action="{{ route('checkpromo') }}" method="post">
                                                @csrf
                                            <div class="row">
                                                @if($datapromo == null)
                                                    <input type="text" name="promo_name" placeholder="Enter promo code" style="width: 100%; padding-right:10px">
                                                    <input type="hidden"  class="site-btn" name="promo_rate" id="promo_rate" value="0">
                                                    @else
                                                {{-- {{ $datapromo->name }} {{$datapromo->rate}} --}}
                                                 <input type="text" name="promo_name" value="{{ $datapromo->name }}" placeholder="Enter promo code" style="width: 100%; padding-right:10px">
                                                 <input type="hidden"  class="site-btn" name="promo_rate" id="promo_rate" value="{{ $datapromo->rate }}">
                                                @endif
                                                <button type="submit" class="site-btn bg-danger" style="font-size: 10px;">APPLY PROMO</button>

                                            </div>

                                        </form>
                                        </div>
                                        </div>
                                <div class="checkout__order__subtotal">Subtotal <span>₱<div style="float:right" id="SubTotalAmt"></div></span></div>



                                <div class="checkout__order__total">Promo/Discount <span>₱<div style="float:right" id="discount"></div></span></div>


                                <div class="checkout__order__total">Total <span>₱<div style="float:right" id="TotalAmt"></div></span></div>

                                <button type="submit" class="site-btn">PLACE ORDER</button>

                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </section>
     <!-- Checkout Section End -->
    <script>

     var arr = document.getElementsByName('product_subtotal[]');
     var data = document.getElementById('promo_rate').value

     var discount = 0
     var subtot=0;
     var total = 0;

     for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
        subtot += parseInt(arr[i].value);
    }
    less = subtot*data;
    beng = subtot-less;

        $('#SubTotalAmt').text(subtot.toFixed(2));
        $('#discount').text(less);
        $('#TotalAmt').text(beng.toFixed(2));




      </script>


   

@endsection
