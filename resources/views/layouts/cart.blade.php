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
    <section class="breadcrumb-section set-bg" data-setbg="/assets/img/breadcrumb.jpg">
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
                                  <input type="checkbox" class="checkit">
                                </td>
                                <td style="display:none">
                                   <p class="productid">{{ $item->id }}</p>
                                  </td>

                                <td class="shoping__cart__item">
                                    <img src="/assets/img/cart/cart-1.jpg" alt="">
                                     <h5><span class="name">{{ $item->name }}</span></h5>
                                </td>
                                <td class="shoping__cart__price">
                                    <span class="price">{{ $item->price }}</span>
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div>
                                        <div>
                                            <form action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id}}" >
                                              <input type="number" name="quantity" value="{{ $item->quantity }}">
                                              <span style="display:none" class="quantity">{{ $item->quantity }}</span>
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
                                    </td>                                </td>


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
                        <button type="submit" class="btn btn-block btn-danger btn-lg cartCheckout">PROCEED TO CHECKOUT</button>
                        <div id="data"></div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

$('.cartCheckout').click(function () {


var rows = [];

// Enumerate over each checked checkbox
$('input:checked').each(function () {
      var currentRow=$(this).closest("tr");

      var productid = currentRow.find(".productid").html();
      var name=currentRow.find(".name").html();
      var price=currentRow.find(".price").html();
      var quantity=currentRow.find(".quantity").html();
      var perItemTotal= currentRow.find(".perItemTotal").html();
      var T = parseInt(quantity)*parseInt(price);
      var data=productid+","+name+","+price+","+quantity+","+T;
    //   var data="id:"+productid+","+"name:"+name+","+"Price:"+price+","+"Quantity:"+quantity+","+"Total:"+T;
      var row = [data];

      rows.push(row);
  // Enumerate over all td elements in the parent tr,
  // skipping the first one (which contains just the
  // checkbox).
 /*  $(this).closest('tr').find('td:not(:first-child)').each(function () {
    // Gather the text into row
    rows.push($(this).text());
  }); */

  // Add this row to our list of rows

});


var CartData =  rows
var myJsonString = JSON.stringify(CartData);
  $('#data').text(myJsonString);

fetch('cartCheckout', {
  method: 'POST',
  headers: {
    'Content-Type': 'json',
  },
  body: myJsonString,
})
.then(response => response.json())
.then(myJsonString => {
  console.log('Success:', myJsonString);
})
.catch((error) => {
  console.error('Error:', myJsonString);
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
