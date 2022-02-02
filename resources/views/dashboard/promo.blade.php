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
            <h1>Promo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Promo</li>
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
                <h3 class="card-title text-red font-weight-bold">Promo</h3>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">
                  Add Promo
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">

                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Rate</th>
                    <th>created_at</th>
                    <th>expired_at</th>
                    <th>Status</th>
                    <th>Action</th>
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

                  @foreach ($promodata as $promodatas)

                  <tr onclick="showDiscount(this)">

                   <td>{{ $promodatas['id'] }}</td>
                    <td>{{ $promodatas['name'] }}</td>
                    <td>{{ $promodatas['rate'] }}</td>
                    <td>{{ $promodatas['created_at'] }}</td>
                    <td>{{ $promodatas['expired_at'] }}</td>

                    <td>
                    @if($promodatas['is_active'] == '1') 

                    <div class="badge bg-green text-white">Active</div>

                    @elseif($promodatas['is_active'] == '0')
                    <div class="badge bg-red text-white">Disabled</div>
                    @endif
                    </td>
                    <td>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default2"><i class="fa fa-edit" ></i></button>
                    <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-archive text-light"></i></button>
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

<!-- Add product modal -->
<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Promo</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('insertpromo') }}" method="POST" enctype="multipart/form-data">
              @csrf
                  <div class="form-group">
                    <label for="name">Promo Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Promo Name">
                </div>
                <div class="form-group">
                    <label for="rate">Rate</label>
                    <input type="text" class="form-control" name="rate" id="rate" placeholder="Enter Promo Rate">
                </div>
                <div class="form-group">
                    <label for="created_at">created at</label>
                    <input type="date" class="form-control" name="created_at" id="created_at">
                </div>
                <div class="form-group">
                    <label for="expired_at">expired at</label>
                    <input type="date" class="form-control" name="expired_at" id="expired_at">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="is_active" id="is_active">
                      <option selected disabled>Select status</option>
                      <option value="1">Active</option>
                      <option value="0">Disabled</option>
                    </select>
                </div>
            </div>

                  <!--
                   <div class="form-group">
                        <label>Category</label>
                        <div class="select2-danger">
                            <select class="select2" name="Category[]" id="category_id" multiple="multiple" data-placeholder="Category" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Gadget</option>
                                <option>Beauty Products</option>
                                <option>Testing</option>
                            </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label>Sub-Category</label>
                        <div class="select2-danger">
                            <select class="select2" name="SubCategory[]" multiple="multiple" data-placeholder="SubCategory" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Gadget</option>
                                <option>Beauty Products</option>
                                <option>Testing</option>
                            </select>
                            </div>
                    </div>
                    -->


                      <!--
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  -->
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger">Add Promo</button>
                    </div>
            </div>

        </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


 <!-- edit product modal -->
<div class="modal fade" id="modal-default2">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Promo</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('updatepromo') }}" method="POST">
              @csrf
              <div class="form-group">
                    <label for="name">Promo Name</label>
                    <input type="text" class="form-control" name="name" id="edit-name" placeholder="Enter Promo Name">
                  </div>
                  <div class="form-group">
                    <label for="rate">Rate</label>
                    <input type="text" class="form-control" name="rate" id="edit-rate" placeholder="Enter Promo Rate">
                </div>
                <div class="form-group">
                    <label for="created_at">created at</label>
                    <input type="date" class="form-control" name="created_at" id="edit-created_at">
                </div>
                <div class="form-group">
                    <label for="expired_at">expired at</label>
                    <input type="date" class="form-control" name="expired_at" id="edit-expired_at">
                </div>

                  <!--
                  <div class="form-group">
                        <label>Category</label>
                        <select class="form-control">
                          <option selected disabled>Category</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Sub-category</label>
                        <select class="form-control">
                          <option selected disabled>Select sub-category</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                      </div>
                    -->

                  <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="is_active" id="edit-is_active">
                          <option selected disabled>Select status</option>
                          <option value="1">Active</option>
                          <option value="0">Disabled</option>
                        </select>
                      </div>
                      <!--
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                -->
            </div>
            <div class="modal-footer justify-content-between">
            <input type="hidden" name="id" id="edit-id">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Save changes</button>
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
          document.getElementById("edit-name").value = j[1].innerHTML;
          document.getElementById("edit-rate").value = j[2].innerHTML;
          document.getElementById("edit-created_at").value = j[3].innerHTML;
          document.getElementById("edit-expired_at").value = j[4].innerHTML;
          document.getElementById("edit-is_active").value = j[5].innerHTML;
          }
      </script>
