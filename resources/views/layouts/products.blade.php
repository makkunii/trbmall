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
              {{-- foreach loop to call all the products --}}
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6" onclick="DisplayProduct(this)">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('public/images/testing.png')}}" data-toggle="modal" data-target="#modal-xl">
                        <ul class="featured__item__pic__hover">
                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- hidden inputs that we pass to the controller --}}
                            <input type="hidden" value="{{ $product->id }}" name="id" id="id">
                            <input type="hidden" value="{{ $product->name }}" name="name" id="name">
                            <input type="hidden" value="{{ $product->price }}" name="price" id="price">
                            <input type="hidden" value="1" name="quantity">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
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


            {{-- details of the products in a modal --}}
        <div class="modal fade" id="modal-xl">
                <div class="modal-dialog  modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">

                                <img src="{{ asset('public/images/testing.png')}}" style="height: 300px">

                            </div>
                            <div class="col-lg-6">
                                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" value="{{ $product->id }}" name="id" id="display-id">
                                    <input type="hidden" value="{{ $product->name }}" name="name" id="display-name">
                                    <input type="hidden" value="{{ $product->price }}" name="price" id="display-price">
                                    <h3 id="display-n"></h3>
                                    <hr>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    <div class="bg-gray py-2 px-3 mt-4">
                                        <h4 class="text-right" id="display-p">

                                        </h4>
                                      </div>
                                    <br>
                                    <input class="btn-default" type="text" value="1" name="quantity"><br><br>
                                    <button class="btn btn-default btn-warning"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                     </form>
                            </div>

                        </div>


                          </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id" id="edit-id">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                  </div>

                </div>

        </div>


<script>
    //passes the products to the input box on the modal via id and query selector
     function DisplayProduct(el)
          {

          document.getElementById("display-id").value =   el.querySelector("#id").value;
          document.getElementById("display-name").value =  el.querySelector("#name").value
          document.getElementById("display-price").value = el.querySelector("#price").value;

          document.getElementById("display-n").innerText = document.getElementById("display-name").value;
          document.getElementById("display-p").innerText = document.getElementById("display-price").value;
          console.log(el);
          }
</script>



        </div>
    </div>
</section>
@endsection
