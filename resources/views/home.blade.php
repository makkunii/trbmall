 @extends('layouts.landingpage') {{-- we extend the landing page here --}}
@extends('layouts.layout') {{-- we extend the layout here  --}}
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
        @if(session()->has('insertsuccess'))
         <div class="alert alert-success alert-dismissible">
            {{ session()->get('insertsuccess') }}
         </div>
         @endif
            <div class="row">
            @include('include.categories')
                <div class="col-lg-9">
                    @include('include.search')
                    <div class="hero__item set-bg" data-setbg="public/assets/img/hero/banner.jpg">
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
       @yield('products')
    @endsection
    <!-- Products Section End -->
