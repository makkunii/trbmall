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
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                  <tbody>
                  @if(session()->has('insertsuccess'))
                    <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session()->get('insertsuccess') }}
                    </div>
                  @endif

                  @if(session()->has('insertfailed'))
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session()->get('insertfailed') }}
                    </div>
                  @endif

                  @foreach ($productdata as $productdatas)

                  <tr>
                    <td>{{ $productdatas['name'] }}</td>
                    <td></td>
                    <td>{{ $productdatas['description'] }}</td>
                    <td>{{ $productdatas['price'] }}</td>
                    <td>
                    @if($productdatas['status'] == '1')

                    <div class="badge bg-green text-white">Active</div>

                    @elseif($productdatas['status'] == '0')
                    <div class="badge bg-red text-white">Disabled</div>
                    @endif
                    </td>
                    <td>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default2" onclick="showDiscount(<?php echo $productdatas['id'] ?>)"><i class="fa fa-edit" ></i></button>
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
              <h4 class="modal-title">Add product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('insertproduct') }}" method="POST" enctype="multipart/form-data">
              @csrf
                  <div class="form-group">
                    <label for="productname">Product name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter product name">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Enter price">
                  </div>
                  <div class="form-group">
                    <label for="price">Category</label>
                    <input type="text" class="form-control" name="subcategory_id" id="subcategory_id" placeholder="Enter category">
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
                  <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="text" class="form-control" name="weight" id="weight" placeholder="Enter weight">
                  </div>
                  <div class="form-group">
                    <label for="length">Length</label>
                    <input type="text" class="form-control" name="length" id="length" placeholder="Enter length">
                  </div>
                  <div class="form-group">
                    <label for="height">Height</label>
                    <input type="text" class="form-control" name="height" id="height" placeholder="Enter height">
                  </div>
                  <!--
                  <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                          <option selected disabled>Select status</option>
                          <option>Active</option>
                          <option>Disabled</option>
                        </select>
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

            </div>
            <div class="modal-footer justify-content-between">
            <input type="hidden" name="status" id="status" value="0">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Add product</button>
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
              <h4 class="modal-title">Edit product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('updateproduct') }}" method="POST">
              @csrf
              <div class="form-group">
                    <label for="productname">Product name</label>
                    <input type="text" class="form-control" name="name" id="edit-name" placeholder="Enter product name">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" id="edit-description" rows="3" placeholder="Enter description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" id="edit-price" placeholder="Enter price">
                  </div>
                  <div class="form-group">
                    <label for="price">Category</label>
                    <input type="text" class="form-control" name="subcategory_id" id="edit-subcategory_id" placeholder="Enter category">
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
                    <label for="weight">Weight</label>
                    <input type="text" class="form-control" name="weight" id="edit-weight" placeholder="Enter weight">
                  </div>
                  <div class="form-group">
                    <label for="length">Length</label>
                    <input type="text" class="form-control" name="length" id="edit-length" placeholder="Enter length">
                  </div>
                  <div class="form-group">
                    <label for="height">Height</label>
                    <input type="text" class="form-control" name="height" id="edit-height" placeholder="Enter height">
                  </div>
                  <!--
                  <div class="form-group">
                        <label>Status</label>
                        <select class="form-control">
                          <option selected disabled>Select status</option>
                          <option>Active</option>
                          <option>Disabled</option>
                        </select>
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
            </form>
            </div>
            <div class="modal-footer justify-content-between">
            <input type="hidden" name="id" id="edit-id" value="">
            <input type="hidden" name="status" id="edit-status" value="0">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <script>
         const showProduct = async (id) => {

          const base = 'https://dev.trbmall.trbexpressinc.net/api/dashboard/products/edit/';

          const query = `${id}`;

          const res = await fetch (base + query);

          const data = await res.json();

          document.querySelector("#edit-id").value = data.Edit.id;

          document.querySelector("#edit-name").value = data.Edit.name;

          document.querySelector("#edit-description").value = data.Edit.description;

          document.querySelector("#edit-price").value = data.Edit.price;

          document.querySelector("#edit-subcategory_id").value = data.Edit.subcategory_id;

          document.querySelector("#edit-weight").value = data.Edit.weight;

          document.querySelector("#edit-length").value = data.Edit.length;

          document.querySelector("#edit-height").value = data.Edit.height;

          document.querySelector("#edit-status").value = data.Edit.status;

          }
      </script>