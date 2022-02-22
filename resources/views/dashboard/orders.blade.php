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
                <table id="example1" class="table table-bordered table-striped">

                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
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


                  @foreach ($vorder as $vorderz)

                  <tr onclick="showDiscount(this)">

                   <td>{{$vorderz['id'] }}</td>
                   <td data-toggle="modal" data-target="#modal-default2">{{$vorderz['first_name'] }} {{$vorderz['last_name'] }}</td>
                   <td>{{$vorderz['brgy'] }}, {{$vorderz['city'] }}, {{$vorderz['province'] }}</td>
                   <td>{{$vorderz['phone'] }}</td>
                   <td>{{$vorderz['email'] }}</td>
                    <td>{{$vorderz['promo'] }}</td>
                    <td>{{$vorderz['total'] }}</td>
                    <td>
                    @if($vorderz['status'] == '1')
                    <div class="badge bg-green text-white">Active</div>
                    @elseif($vorderz['status'] == '0')
                    <div class="badge bg-red text-white">Cancelled</div>
                    @endif
                    </td>
                    <td style="display:none;">{{$vorderz['products'] }}</td>
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



 <!-- edit product modal -->
<div class="modal fade" id="modal-default2">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View Order</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form>
              @csrf

              <div class="form-group">
                  <div class="row">
                    <div class="col-lg-6">
                        <label for="productname">Products</label>
                        <input type="text" class="form-control" name="name" id="edit-product" style="background: transparent; border: none;">
                    </div>
                    <div class="col-lg-6">
                        <label for="productname">Quantity</label>
                        <p>Products Quantity</p>
                    </div>
                  </div>

                  </div>
                  <input type="hidden" class="form-control" name="id" id="edit-id">
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <script>
          function showDiscount(row)
          {
          var j = row.cells;
          document.getElementById("edit-id").value = j[0].innerHTML;
          document.getElementById("edit-product").value = j[8].innerHTML;
          }
      </script>
