@extends('home')
@section('content')
@section('title', 'Purchase History')
<meta name="csrf-often" content="{{ csrf_token() }}">
<style>

    /* this customizes the form  */
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


    <!-- Users Details Section Begin using the blog details template -->

    <section class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">

                         {{-- this is the left side of the page  --}}
                    <div class="blog__sidebar">

                            <div class="blog__details__author">
                                <div class="blog__details__author__pic">
                                    <img src="{{ asset('public/images/testing.png')}}" alt="">
                                </div>
                                <div class="blog__details__author__text">
                                    <h6>Michael Scofield</h6>
                                    <span>Profile</span>
                                </div>
                            </div>
                                <br>

                        <div class="blog__sidebar__item">

                            <ul>
                                <li><a   href="{{ route('users.user')}}"><i class="fas fa-address-card"></i> My Account</a></li>
                                <li><a  href="{{ route('users.purchase')}}"><i class="fas fa-shopping-basket"></i> My Purchase</a></li>
                                <li><a  href="https://dev.trbmall.trbexpressinc.net/logout" session_destroy();><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </div>

                        {{-- <div class="blog__sidebar__item">
                            <h4>Search By</h4>
                            <div class="blog__sidebar__item__tags">
                                <a href="#">Apple</a>
                                <a href="#">Beauty</a>
                                <a href="#">Vegetables</a>
                                <a href="#">Fruit</a>
                                <a href="#">Healthy Food</a>
                                <a href="#">Lifestyle</a>
                            </div>
                        </div> --}}
                    </div>
                </div>

                {{-- here is the right side of the page  --}}
                    <div class="col-lg-8 col-md-7 order-md-1 order-1">
                        <div class="blog__details__text">
                            <div class="card">
                                <div class="card-body">
                            <p>My Orders</p>
                            <table id="example1" class="table table-bordered table-striped">

                                <thead>

                                <tr>
                                  <th>ID</th>
                                  <th>Products ID</th>
                                  <th>Status</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(session()->has('insertsuccess'))
                                  <div class="alert alert-success alert-dismissible">
                                      {{ session()->get('insertsuccess') }}
                                  </div>
                                @endif

                                @if(session()->has('insertfailed'))
                                  <div class="alert alert-danger alert-dismissible">
                                      {{ session()->get('insertfailed') }}
                                  </div>
                                @endif

                                @if(session()->has('updatesuccess'))
                                  <div class="alert alert-success alert-dismissible">
                                      {{ session()->get('updatesuccess') }}
                                  </div>
                                @endif

                                @if(session()->has('updatefailed'))
                                  <div class="alert alert-danger alert-dismissible">
                                      {{ session()->get('updatefailed') }}
                                  </div>
                                @endif




                                <tr onclick="showDiscount(this)">

                                 <td><div class="row">
                                     <div class="col-lg-6">
                                        <div class="blog__details__author__pic">
                                            <img src="{{ asset('public/images/testing.png')}}" alt="">
                                        </div>
                                     </div>
                                     <div class="col-lg-6">
                                        EWAN ANO FIELDS NITO WHAAHH
                                     </div>
                                 </div>

                                  </td>
                                 <td>wewa</td>
                                 <td>

                                  <div class="badge bg-green text-white">Active</div>

                                  </td>
                                </tr>



                                </tbody>

                              </table>
                        </div>



                    </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->




@endsection
