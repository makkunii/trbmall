@extends('layouts.landingpage')
@extends('layouts.layout')
@section('title', 'Home')

@section('content')
 <!-- Page Preloder -->
 <div id="preloder">
        <div class="loader"></div>
    </div>
    
    <br>

    <!-- Categories Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
            @include('include.categories')
                <div class="col-lg-9">
                    @include('include.search')
                    <div class="hero__item set-bg" data-setbg="assets/img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>TRB MALL</span>
                            <h2>A fresh approach<br>to shopping.</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Products Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Products</h2>
                    </div>
                </div>
            </div>

            <table id="example1" class="table">

            <thead>
                  <tr>
                    <th></th>
                  </tr>
                  </thead>

                  <tbody>
                  <tr>
                    <td>
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="assets/img/featured/feature-1.jpg">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
            </td>
                  </tr>
                  </tbody>

                </table>
                

           
    </section>
    @endsection
    <!-- Products Section End -->
