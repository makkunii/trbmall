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
            <h1>Orders Transaction</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transactions</li>
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
                <h3 class="card-title text-red font-weight-bold">Transaction table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
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


                  @foreach ($torder as $torderz)

                  <tr onclick="showDiscount(this)">

                   <td>{{$torderz['id'] }}</td>
                   <td>{{$torderz['product_id'] }}</td>
                   <td>
                    @if($torderz['status'] == '1')
                    <div class="badge bg-green text-white">Active</div>
                    @elseif($torderz['status'] == '0')
                    <div class="badge bg-red text-white">Cancelled</div>
                    @endif
                    </td>
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
                        <p>Products na inorder ni user</p>
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
           //   this is where we get the row value and pass it on to the input field on a modal
          function showDiscount(row)
          {
          var j = row.cells;
          document.getElementById("edit-id").value = j[0].innerHTML;
          document.getElementById("customer").value = j[1].innerHTML;
          document.getElementById("edit-address").value = j[2].innerHTML;
          document.getElementById("edit-phone").value = j[3].innerHTML;
          document.getElementById("edit-email").value = j[4].innerHTML;
          document.getElementById("edit-promo").value = j[5].innerHTML;
          document.getElementById("edit-products").value = j[6].innerHTML;
          document.getElementById("edit-total").value = j[7].innerHTML;
          document.getElementById("edit-name").value = j[8].innerHTML;
          }
      </script>
