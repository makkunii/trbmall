@extends('layouts.master')
@section('title','TRB Mall Admin')
<div class="wrapper">
@include('include.sidebar')
@include('include.navbar')
<style>
    .select2-selection__rendered {
    line-height: 25px !important;
    margin-bottom: 50px  !important;

    }
    .select2 option {
        height: 24px;
    }
</style>





 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


            <div class="card">
              <div class="card-header text-right bg-light">
                <h3 class="card-title text-red font-weight-bold">Orders table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <input type="hidden" class="form-control order_idz" name="order_id" id="order_id">
                <table id="example1" class="table table-bordered table-striped">

                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Subtotal</th>
                    <th>Promo</th>
                    <th>Total</th>
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


    {{--a loop to call all the data  --}}
                  @foreach ($vorder as $vorderz)
                    {{-- on click to call the function showDiscount on the script --}}
                  <tr onmouseover="showDiscount(this)">
                   <td>{{$vorderz['id'] }} </td>

                   <td><button type="button" class="btn btn-transparent btn-sm viewproduct" data-toggle="modal" data-target="#productmodal">{{$vorderz['first_name'] }} {{$vorderz['last_name'] }}</button></td>
                   <td>{{$vorderz['brgy'] }}, {{$vorderz['city'] }}, {{$vorderz['province'] }}</td>
                   <td>{{$vorderz['phone'] }}</td>
                   <td>{{$vorderz['email'] }}</td>
                   <td>{{$vorderz['subtotal'] }}</td>
                    <td>{{$vorderz['promo'] }}</td>
                    <td>{{$vorderz['total'] }}</td>
                    <td>
                        {{-- this is to change the status --}}
                      @if ($vorderz['status'] == "Pending")
                    <button type="button" class="btn btn-warning btn-sm btn-block text-bold" data-toggle="modal" data-target="#orderstatus">{{$vorderz['status'] }}</button>
                      @elseif ($vorderz['status'] == "COP")
                      <button type="button" class="btn btn-primary btn-sm btn-block text-bold" data-toggle="modal" data-target="#orderstatus">{{$vorderz['status'] }}</button>
                      @elseif ($vorderz['status'] == "COD")
                      <button type="button" class="btn btn-primary btn-sm btn-block text-bold" data-toggle="modal" data-target="#orderstatus">{{$vorderz['status'] }}</button>
                      @elseif ($vorderz['status'] == "Cancelled")
                      <button type="button" class="btn btn-danger btn-sm btn-block text-bold" data-toggle="modal" data-target="#orderstatus">{{$vorderz['status'] }}</button>
                     @endif
                  </td>

                    <!-- data-toggle="modal" data-target="#modal-default2" -->

                    <!-- <td><button type="button" class="btn btn-danger btn-sm viewproduct" data-toggle="modal" data-target="#productmodal">View</button></td> -->

                  </tr>
                  @endforeach


                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  @include('include.footer')
  </div>
<!-- ./wrapper -->



 <!-- product modal -->
<div class="modal fade" id="productmodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View Order</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <div id="loader" style="display:none;">Loading...</div>
                <div id="orders_table">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Products</th>
                        <th style="width: 100px">Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>

                        <!-- <td></td>
                        <td><input type="text" class="form-control" name="name" id="edit-product" style="background: transparent; border: none;"></td>
                        <td> <input type="text" class="form-control" name="name" id="edit-qty" style="background: transparent; border: none;"></td>
                       -->
                      </tr>
                    </tbody>
                </table>
                </div>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- order status modal -->
<div class="modal fade" id="orderstatus">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Order Status</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <form action="{{ URL::route('updatestatus') }}" method="POST">
                  @csrf
                <input type="hidden" value="" name="order_idzz" id="order_idzz">
                  <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                          <option selected disabled>Select status</option>
                          <option value="1">Pending</option>
                          <option value="2">COP</option>
                          <option value="3">COD</option>
                          <option value="4">Cancelled</option>
                        </select>
                  </div>

                      <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger">Save</button>

                    </div>

               </form>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>


      <script>
          // shows the products in a modal
        $(document).ready(function(){

          $('.viewproduct').on('click', function(){

            $("#loader").show();
            var order_id = $('.order_idz').val();
            // alert(order_id);
            //$('#productmodal').modal('show');
            $.ajax({
              type:'POST',
              url: '{{ route("show_ordered_products") }}',
              data:'order_id='+order_id+'&_token={{csrf_token()}}',
              success:function(result){
                $("#loader").hide();
                $("#orders_table").html(result);
              }

          });
          });

        });
      </script>

<script>
        // passs the row data to the id assigned
          function showDiscount(row)
          {
          var j = row.cells;
          document.getElementById("order_id").value = j[0].innerHTML;
          document.getElementById("order_idzz").value = j[0].innerHTML;
          }
      </script>
