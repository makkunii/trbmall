@extends('home')
@section('content')
@section('title', 'Checkout')
<style>
  /* custom select style for the provinces select field */
   select{
   height: 45px !important;
   border: 1px solid #ABADB3;
   margin: 0;
   padding: 0;
   vertical-align: top;
   }
   input[placeholder], [placeholder], *[placeholder] {
    color: rgb(0, 0, 0) !important;
}
</style>
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
         <h4>Shipping Address</h4>

         @if(session()->has('insertfailed'))
         <div class="alert alert-danger alert-dismissible">
            {{ session()->get('insertfailed') }}
         </div>
         @endif
         <div class="row">
            <div class="col-lg-8 col-md-6">
               <form id="my-form" action="{{ route('insertorder') }}" method="POST">
                  @csrf
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="checkout__input">
                           <p>First Name<span>*</span></p>
                           <input type="text" placeholder="Enter first name" name="first_name" id="first_name">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="checkout__input">
                           <p>Last Name<span>*</span></p>
                           <input type="text" placeholder="Enter last name" name="last_name" id="last_name">
                        </div>
                     </div>
                  </div>

                  {{-- the select where we get the province city and barangay relatively --}}
                  <div class="form-group">
                     <p>Province<span>*</span></p>
                     <select class="form-control province text-muted" name="province" id="province">
                        <option selected disabled>Select province</option>
                        <?php foreach ($province as $prov) { ?>
                        <option value="<?php echo $prov['provDesc'];?>"><?php echo $prov['provDesc'];?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <p>City<span>*</span></p>
                     <select class="form-control city text-muted" name="city" id="city">
                        <option value="null" selected disabled> Select Province first </option>
                     </select>
                  </div>
                  <div class="form-group">
                     <p>Barangay<span>*</span></p>
                     <select class="form-control brgy text-muted" name="brgy" id="brgy">
                        <option value="null" selected disabled> Select City/Municipality first </option>
                     </select>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="checkout__input">
                           <p>Phone<span>*</span></p>
                           <input type="text" placeholder="Enter Phone Number" name="phone" id="phone">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="checkout__input">
                           <p>Email<span>*</span></p>
                           <input type="text" placeholder="Enter Email" name="email" id="email">
                        </div>
                     </div>
                  </div>
                    </div>
            <!-- end -->
            <div class="col-lg-4 col-md-6">
            <div class="checkout__order">
            <h4>Your Order</h4>
            <div class="checkout__order__products">Products <span>Total</span></div>
            <ul>
            {{-- we loop the session to call all of the array session  --}}
            @foreach(Session::get('data')['product_id'] as $index => $product)
            <li>
            {{ Session::get('data')['product_name'][$index] }} - {{ Session::get('data')['product_qty'][$index] }}


            {{-- here it checks if there is not promo --}}
            @if($datapromo == null)
            {{-- here we update the value of the session promo to 1  --}}
            {{ session()->put('data.promo',1);}}
            {{--  we do math with the session to compute the price with the promo which null--}}
            <span>??? {{ (Session::get('data')['product_qty'][$index]*Session::get('data')['product_price'][$index])*
                Session::get('data')['promo']
            }} </span>
            @else
            {{-- else we update the session promo with the promo rate that we had applied  --}}
            {{ session()->put('data.promo',$datapromo->rate);}}
              {{--  we do math with the session to compute the price with the product price, quantity and promo rate--}}
            <span>???{{ (Session::get('data')['product_qty'][$index]*Session::get('data')['product_price'][$index])*
                Session::get('data')['promo']
            }} (<del>{{ Session::get('data')['product_qty'][$index]*Session::get('data')['product_price'][$index] }}</del>)</span>
            @endif
            <input type="hidden" name="product_id[]" class="product-id" id="product-id" value="{{ Session::get('data')['product_id'][$index] }}">
            <input type="hidden" name="product_name[]" class="product-name" id="product-name" value="{{ Session::get('data')['product_name'][$index] }}">
            <input type="hidden" name="product_price[]" class="product-price" id="product-price" value="{{ Session::get('data')['product_price'][$index] }}">
            <input type="hidden" name="product_qty[]" class="product-qty" id="product-qty" value="{{ Session::get('data')['product_qty'][$index] }}">
            <input type="hidden" name="product_subtotal[]" class="product-subtotal" id="product-subtotal"
               value="{{ (Session::get('data')['product_qty'][$index]*Session::get('data')['product_price'][$index])*
               Session::get('data')['promo'] }}">
            </li>
            @endforeach
            </ul>
            <div class="checkout__order__subtotal">Subtotal <span>???<div style="float:right" id="SubTotalAmt"></div></span></div>
            <div class="checkout__order__total">Promo/Discount <span>???<div style="float:right" id="discount"></div></span></div>
            <div class="checkout__order__total">Total <span>???<div style="float:right" id="TotalAmt"></div></span></div>
            <input type="hidden" name="subtotal" value="" id="subtotal">
            <input type="hidden" name="total" value="" id="total">
            <input type="hidden" name="promo" value="" id="promo">
            <input type="hidden" name="products" value="" id="products">
            <input type="hidden" name="quantity" value="" id="quantity">
            <input type="hidden"  class="status" name="status" id="status" value="1">
            {{-- <button type="submit" class="site-btn">PLACE ORDER</button> --}}
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">
                Place Order
              </button>
            </form>
            <div class="shoping__discount">
            <div class="checkout__input">
            <form action="{{ route('checkpromo') }}" method="post">
            @csrf
            <div class="row">
                {{-- it checks if there is a promo if null --}}
                @if($datapromo == null)
                <input type="text" id="promo_name" name="promo_name" placeholder="Enter promo code" style="width: 100%; padding-right:10px">
                <input type="hidden"  class="site-btn" name="promo_rate" id="promo_rate" value="0">
                <button type="submit" class="site-btn bg-danger" style="font-size: 10px;">APPLY PROMO</button>
                @else


                <div class="alert alert-success alert-dismissible">
                Promo applied successfully
                </div>
                {{-- {{ $datapromo->name }} {{$datapromo->rate}} --}}

                {{-- here we check if the promo is active or null
                    if null you can apply promo else yo ucant appy a promo --}}
            @if($PromoStatus == null)
                   <input type="text" id="promo_name" name="promo_name" value="{{ $datapromo->name }}" placeholder="Enter promo code" style="width: 100%; padding-right:10px">
                   <input type="hidden"  class="site-btn" name="promo_rate" id="promo_rate" value="{{ $datapromo->rate }}">
                   <button type="submit" class="site-btn bg-danger" style="font-size: 10px;">APPLY PROMO</button>
            @else
                  <input type="text" id="promo_name" name="promo_name" value="{{ $datapromo->name }}" placeholder="Enter promo code" style="width: 100%; padding-right:10px" disabled>
                  <input type="hidden"  class="site-btn" name="promo_rate" id="promo_rate" value="{{ $datapromo->rate }}">
                  <button type="submit" disabled  style="font-size: 10px; color:white">APPLY PROMO</button>
             @endif
                @endif

            </div>
            </form>
            </div>
            </div>
            </div>
            </div>
         </div>
      </div>
   </div>

   {{-- a modal that shows the payment --}}
   <div class="modal fade" id="modal-danger">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Payment Method</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="row">
               <div class="col-lg-6">
                   <h3>Pay through Gcash</h3><br>
                <div class="checkout__input">
                    <p>Step 1<span>*</span></p>
                    Login to your Gcash App
                 </div>
                 <div class="checkout__input">
                    <p>Step 2<span>*</span></p>
                    Proceed to Send Money/Express Send
                 </div>
                 <div class="checkout__input">
                    <p>Step 3<span>*</span></p>
                    Input the Credentials<br>
                    Mobile Number and the amount that you need to pay
                 </div>





                </div>
           <div class="col-lg-6">

            <div class="checkout__input">
                <p>Payment Center/E-Wallet<span></span></p>

                <div class="checkout__input">
                    <button type="button" class="btn btn-block btn-success btn-lg"><i class="fas fa-credit-card"></i> Paymaya</button>
                 </div>
                 <div class="checkout__input">
                    <button type="button" class="btn btn-block btn-info btn-lg"><i class="fab fa-paypal"></i> Paypal</button>
               </div>

           </div>
        </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-outline-danger">Pay Orders</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

</section>
<!-- Checkout Section End -->
<script>
    // we get the subtotal and the promo rate
   var arr = document.getElementsByName('product_subtotal[]');
   var data = document.getElementById('promo_rate').value

   var discount = 0
   var subtot=0;
   var total = 0;

   for(var i=0;i<arr.length;i++){
      if(parseInt(arr[i].value))
      subtot += parseInt(arr[i].value);
   }
   // we do a math to calculate the subtotal and the total with the promo and the discoutned price
   less = subtot*data;
   beng = subtot-less;

   // we assign it to a text
      $('#SubTotalAmt').text(subtot.toFixed(2));
      $('#discount').text(less);
      $('#TotalAmt').text(beng.toFixed(2));


    //  for(var i=0;i<arr.length;i++){
    //     var testing = parseInt(arr[i].value)*data;
    //     console.log(testing);
    //     document.getElementById("subtotal").value = testing
    //  }


      document.getElementById("total").value = beng;
      document.getElementById("promo").value = document.getElementById("promo_name").value;
      document.getElementById("products").value = document.getElementById("product-name").value;
      document.getElementById("subtotal").value = document.getElementById("product-subtotal").value;
      document.getElementById("quantity").value = document.getElementById("product-qty").value;

</script>
@endsection
