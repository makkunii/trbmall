@extends('home')

@section('products')
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="images/testing.png">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>

                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->name }}" name="name">
                            <input type="hidden" value="{{ $product->price }}" name="price">
                            <input type="hidden" value="1" name="quantity">
                            <li><button class="btn btn-block btn-warning"><i class="fa fa-shopping-cart"></i> Add to Cart</button></li>
                            </form>

                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">{{ $product->name }}</a></h6>
                        <h5>P{{ $product->price }}</h5>
                    </div>
                </div>
            </div>
            @endforeach





        </div>
    </div>
</section>
@endsection
