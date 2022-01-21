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
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                <h3 class="card-title text-red font-weight-bold">Product table</h3>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">
                  Add product
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">

                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>Iphone</td>
                    <td></td>
                    <td>Iphone XR</td>
                    <td>35,000</td>
                    <td>Gadget</td>
                    <td>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default2"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-archive text-light"></i></button>
                    </td>
                  </tr>
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
              <h4 class="modal-title">Add product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form>
              @csrf
                  <div class="form-group">
                    <label for="productname">Product name</label>
                    <input type="text" class="form-control" id="productname" placeholder="Enter product name" required>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" placeholder="Enter description" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter price" required>
                  </div>
                   <div class="form-group">
                        <label>Category</label>
                        <div class="select2-danger">
                            <select class="select2" name="Category[]" multiple="multiple" data-placeholder="Category" data-dropdown-css-class="select2-danger" style="width: 100%;">
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
                  <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="text" class="form-control" id="weight" placeholder="Enter weight">
                  </div>
                  <div class="form-group">
                    <label for="length">Length</label>
                    <input type="text" class="form-control" id="length" placeholder="Enter length">
                  </div>
                  <div class="form-group">
                    <label for="height">Height</label>
                    <input type="text" class="form-control" id="height" placeholder="Enter height">
                  </div>
                  <div class="form-group">
                        <label>Status</label>
                        <select class="form-control">
                          <option selected disabled>Select status</option>
                          <option>Active</option>
                          <option>Disabled</option>
                        </select>
                      </div>
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
            </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger">Add product</button>
            </div>
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
              <h4 class="modal-title">Edit product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form>
              @csrf
                  <div class="form-group">
                    <label for="productname">Product name</label>
                    <input type="text" class="form-control" id="productname" placeholder="Enter product name" required>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" placeholder="Enter description" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter price" required>
                  </div>
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
                  <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="text" class="form-control" id="weight" placeholder="Enter weight">
                  </div>
                  <div class="form-group">
                    <label for="length">Length</label>
                    <input type="text" class="form-control" id="length" placeholder="Enter length">
                  </div>
                  <div class="form-group">
                    <label for="height">Height</label>
                    <input type="text" class="form-control" id="height" placeholder="Enter height">
                  </div>
                  <div class="form-group">
                        <label>Status</label>
                        <select class="form-control">
                          <option selected disabled>Select status</option>
                          <option>Active</option>
                          <option>Disabled</option>
                        </select>
                      </div>
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
            </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
