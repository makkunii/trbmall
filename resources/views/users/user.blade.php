@extends('home')
@section('content')
@section('title', 'Profile')
<meta name="csrf-often" content="{{ csrf_token() }}">
<style>
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
 {{-- this is the left side of the page  --}}
                        <div class="blog__sidebar__item">

                            <ul>
                                <li><a   href="{{ route('users.user')}}"><i class="fas fa-address-card"></i> My Account</a></li>
                                <li><a  href="{{ route('users.purchase')}}"><i class="fas fa-shopping-basket"></i> My Purchase</a></li>

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
                                <div class="tab-content">
                                <div class="tab-pane active" id="activity">

                                <div class="post">
                                    <h4>Information</h4><br>
                                    <div class="row">
                                        <div class="col-lg-4">

                                            <div class="blog__details__author__pic float-left">
                                                <img src="{{ asset('public/images/testing.png')}}" alt="">
                                            </div>

                                    </div>

                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="checkout__input">
                                                    First Name<span>*</span>
                                                    <input type="text" placeholder="Enter first name" name="first_name" id="first_name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="checkout__input">
                                                    Last Name<span>*</span>
                                                    <input type="text" placeholder="Enter last name" name="last_name" id="last_name">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="checkout__input">
                                                Phone<span>*</span>
                                                <input type="text" placeholder="Enter Phone Number" name="phone" id="phone">
                                            </div>
                                            <div class="checkout__input">
                                                Email<span>*</span>
                                                <input type="text" placeholder="Enter Email" name="email" id="email">
                                            </div>
                                            <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-danger">
                                                Save
                                              </button>


                                        </div>

                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                    </div>







                            </div>

                        </div>


                        <div class="blog__details__text">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="activity">
                                            {{-- here we call the provinces, city and barangay relavtivly --}}
                                        <div class="post">
                                            <h4>Address</h4><br>
                                            <div class="checkout__input">
                                               Complete Address<span>*</span>
                                                <input type="text" placeholder="Enter Complete Address" name="first_name" id="first_name">
                                                </div>
                                            <div class="form-group">
                                                Province<span>*</span>
                                                <select class="form-control province text-muted" name="province" id="province">
                                                   <option selected disabled>Select province</option>
                                                   <?php foreach ($province as $prov) { ?>
                                                   <option value="<?php echo $prov['provDesc'];?>"><?php echo $prov['provDesc'];?></option>
                                                   <?php } ?>
                                                </select>
                                             </div>
                                             <div class="form-group">
                                                City<span>*</span>
                                                <select class="form-control city text-muted" name="city" id="city">
                                                   <option value="null" selected disabled> Select Province first </option>
                                                </select>
                                             </div>
                                             <div class="form-group">
                                               Barangay<span>*</span>
                                                <select class="form-control brgy text-muted" name="brgy" id="brgy">
                                                   <option value="null" selected disabled> Select City/Municipality first </option>
                                                </select>
                                             </div>
                                             <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-danger">
                                                Save
                                              </button>



                                        </div>
                                    </div>
                                    </div>
                                 </div>
                            </div>







                            </div>

                        </div>
                    </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--users Details Section End -->



@endsection
