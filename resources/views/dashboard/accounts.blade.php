@extends('layouts.master')
@section('title','TRB Mall Admin')
<div class="wrapper">
@include('include.sidebar')
@include('include.navbar')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Accounts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Accounts</li>
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
                    <div class="card-header">
                        <h3 class="card-title">
                            Account List
                            -
                            <select id="result-count">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            -
                            <span id="total-results"></span>
                            Results
                        </h3>
                        <div class="card-tools">
                            <div class="input-group" style="width: 150px;">
                                <input type="text" id="search-field" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <button type="button" class="float-right btn bg-gradient-danger" data-toggle="modal"
                                data-target="#add-modal">
                                Add Account
                            </button>
                        </div>
                        {{-- Table --}}
                        <div id="table-container">

                        </div>
                        {{-- Pagination --}}
                        <div id="pagination-footer" class="card-footer clearfix"></div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('include.footer')
  </div>
<!-- ./wrapper -->

{{-- Create Modal --}}
<div class="modal fade" id="add-modal">
    <div class="modal-dialog modal-lg">

        <form id="add-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card-body">

                        <div class="form-group">
                            <label for="add-name">Name</label>
                            <input type="text" class="form-control" id="add-name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="add-email">Email Address/Mobile Num</label>
                            <input type="text" class="form-control" id="add-email" placeholder="Enter Email/Mobile">
                        </div>
                        <div class="form-group">
                            <label for="add-contact">Contact Number</label>
                            <input type="text" class="form-control" id="add-contact" placeholder="Enter Contact Number">
                        </div>
                        <div class="form-group">
                            <label for="add-address">Address</label>
                            <input type="text" class="form-control" id="add-address" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label for="add-role">Role</label>
                            <select class="custom-select rounded-0" id="add-role">

                            </select>
                        </div>
                        <div class="form-group" id="add-speciality-dropdown">
                            <label for="add-speciality">Speciality</label>
                            <select class="custom-select rounded-0" id="add-speciality">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="add-status">Status</label>
                            <select class="custom-select rounded-0" id="add-status">
                                <option value="1">Deactivated</option>
                                <option value="2">Active</option>
                                <option value="3">Restricted</option>
                                <option value="4">Debug</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="add-password">Password</label>
                            <input type="password" class="form-control" id="add-password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="add-password-confirm">Confirm Password</label>
                            <input type="password" class="form-control" id="add-password-confirm"
                                placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" id="add-modal-close" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn bg-gradient-danger">
                        Save Account
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

{{-- Update Modal --}}
<div class="modal fade" id="edit-modal">
    <div class="modal-dialog modal-lg">

        <form id="edit-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="edit-title" class="modal-title">View Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="edit-created">Date Created</label>
                            <input type="text" class="form-control" id="edit-created" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit-updated">Last Updated</label>
                            <input type="text" class="form-control" id="edit-updated" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit-deleted">Date Deleted</label>
                            <input type="text" class="form-control" id="edit-deleted" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit-id">ID</label>
                            <input type="text" class="form-control" id="edit-id" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email/Mobile</label>
                            <input type="text" class="form-control" id="edit-email" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit-name">Name</label>
                            <input type="text" class="form-control" id="edit-name" placeholder="Enter Name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit-contact">Contact Number</label>
                            <input type="text" class="form-control" id="edit-contact" placeholder="Enter Contact Number" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit-address">Address</label>
                            <input type="text" class="form-control" id="edit-address" placeholder="Enter Address" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit-type">Registration Type</label>
                            <input type="text" class="form-control" id="edit-type" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit-role">Role</label>
                            <select class="custom-select rounded-0" id="edit-role" disabled>

                            </select>
                        </div>
                        <div class="form-group" id="edit-speciality-dropdown">
                            <label for="edit-speciality">Speciality</label>
                            <select class="custom-select rounded-0" id="edit-speciality" disabled>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-status">Status</label>
                            <select class="custom-select rounded-0" id="edit-status" disabled>
                                <option value="1">Deactivated</option>
                                <option value="2">Active</option>
                                <option value="3">Restricted</option>
                                <option value="4">Debug</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-password">Password</label>
                            <input type="password" class="form-control" id="edit-password" placeholder="Password" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit-password-confirm">Confirm Password</label>
                            <input type="password" class="form-control" id="edit-password-confirm" placeholder="Confirm Password" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" id="edit-modal-close" data-dismiss="modal">
                        Close
                    </button>
                    <button onclick="editMode(true)" type="button" class="btn bg-gradient-info" id="edit-toggle-button">
                        Update Account
                    </button>
                    <button onclick="editMode(false); showSingle(document.querySelector('#edit-id').value);"
                        type="button" class="btn bg-gradient-danger" id="edit-cancel-button" style="display: none">
                        Cancel
                    </button>
                    <button type="submit" class="btn bg-gradient-success" id="edit-update-button" style="display: none">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
//////////////////////////////  Elements //////////////////////////
const api_url = '/api/v1/a/accounts';
const table_div = document.querySelector('#table-container');
const pagination_div = document.querySelector('#pagination-footer');
const search_input = document.querySelector('#search-field');
const resultCount = document.querySelector('#result-count');
const totalResults= document.querySelector('#total-results');
//////////////////////////////  Elements  //////////////////////////

const getData = async (url) => {
    try {
        const data = await fetch(url);
        const res = data.json();
        return res;
    }
    catch (error) {
        console.log(error);
    }
};

const postData = async (url, formData) => {
    try {
        const csrf = document.querySelector('meta[name="csrf-token"]').content;
        const data = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(formData),
            headers: {
                "Content-Type": "application/json",
                'Accept': 'application/json',
                'X-CSRF-Token': csrf
            }
        });
        const res = data.json();
        return res;
    }
    catch (error) {
        console.log(error);
    }
};

const parseUTC = (utc, dayOnly = false, timeOnly = false) => {

    if (!utc) {
        return '';
    }

    const parsed = new Date(utc);
    const [ day, time ] = parsed.toLocaleString().split(',');

    if (dayOnly) {
        return day;
    }

    if (timeOnly) {
        return time;
    }

    return parsed;
};

//////////////////////////////  TABLE  //////////////////////////

const paginate = (el, data) => {
    el.innerHTML = `
    <ul class="pagination pagination-sm m-0 float-right" style="cursor: pointer;">
        <li id="first-page" class="page-item">
            <a class="page-link" onclick="loadTable('${data.links.first}')">«</a>
        </li>

        ${data.links.prev
            ? `<li id="next-page" class="page-item">
                    <a class="page-link" onclick="loadTable('${data.links.prev}')">${data.meta.current_page - 1}</a>
                </li>
                `
            : ''
        }

        <li id="current-page" class="page-item">
            <a class="page-link text-danger">${data.meta.current_page}</a>
        </li>

        ${data.links.next
            ? `<li id="next-page" class="page-item">
                    <a class="page-link" onclick="loadTable('${data.links.next}')">${data.meta.current_page + 1}</a>
                </li>
                `
            : ''
        }

        <li id="last-page" class="page-item">
            <a class="page-link" onclick="loadTable('${data.links.last}')">»</a>
        </li>
    </ul>
    <span id="total-pages">${data.meta.last_page} Pages</span>
    `;
};

// Load Table
const loadTable = async (url) => {
    // Pagination
    if (url.includes('?')) {
        url += `&p=${resultCount.value}`;
    }
    else {
        url += `?p=${resultCount.value}`;
    }

    // Get Data
    const data = await getData(url);
    console.log(data);
    if (data.message) {
        toastr.error('Error Loading Table');
        return;
    }

    // Paginate
    totalResults.textContent = data.meta.total;
    paginate(pagination_div, data);

    // Format Data
    let temp = '';
    data.data.forEach(record => {
        temp += `
        <tr>
            <td>${record.id}</td>
            <td>${record.name}</td>
            <td>${record.email}</td>
            <td>${record.contact}</td>
            <td>${record.role}</td>
            <td>
                <button
                    onclick="showSingle(${record.id}); editMode(false);"
                    type="button"
                    class="btn bg-gradient-success"
                    data-toggle="modal"
                    data-target="#edit-modal">
                    View
                </button>
            </td>
        </tr>
        `;
    });

    // Display Data
    table_div.innerHTML = `
    <table id="main-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="table-body">
            ${temp}
        </tbody>
        <tfoot>
            <!-- Footer -->
        </tfoot>
    </table>
    `;

    // Initialize Datatable
    $("#main-table")
        .DataTable({
            "responsive": true,
            "searching": false,
            "lengthChange": false,
            "autoWidth": false,
            "autoHeight": false,
            "paging": false,
            "ordering": true,
            "info": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        })
        .buttons()
        .container()
        .appendTo('#main-table_wrapper .col-md-6:eq(0)');
};

// Search
const searchUsers = (url) => {
    if (search_input.value === ''){
        loadTable(url);
    }

    if (search_input.value.trim().length < 2) {
        return;
    }

    loadTable(`${url}?q=${search_input.value}`);
}

//////////////////////////////  TABLE  //////////////////////////

//////////////////////////// Add Record //////////////////////////
const addRecord = async (e) => {
    e.preventDefault();

    const store_url = '/api/v1/a/accounts';
    const data = {
        name: document.querySelector('#add-name').value,
        email: document.querySelector('#add-email').value,
        contact: document.querySelector('#add-contact').value,
        address: document.querySelector('#add-address').value,
        role_id: document.querySelector('#add-role').value,
        status_id: document.querySelector('#add-status').value,
        password: document.querySelector('#add-password').value,
        password_confirmation: document.querySelector('#add-password-confirm').value
    };

    const res = await postData(store_url, data);
    if (res.message) {
        toastr.error(res.message);
    }
    else {
        toastr.success(`${data.name} was successfully created.`);
        document.querySelector('#add-name').value = '';
        document.querySelector('#add-email').value = '';
        document.querySelector('#add-contact').value = '';
        document.querySelector('#add-address').value = '';
        document.querySelector('#add-status').value = '';
        document.querySelector('#add-role').value = '';
        document.querySelector('#add-password').value = '';
        document.querySelector('#add-password-confirm').value = '';
        loadTable(api_url);
    }

    document.querySelector('#add-modal-close').click();
}
document.querySelector('#add-form').addEventListener('submit', e => addRecord(e));
//////////////////////////// Add Record //////////////////////////
//////////////////////////// Edit Record /////////////////////////
const editRecord = async (e) => {
    e.preventDefault();

    const update_url = `/api/v1/a/accounts/${document.querySelector('#edit-id').value}`;
    let data = {
        name: document.querySelector('#edit-name').value,
        contact: document.querySelector('#edit-contact').value,
        address: document.querySelector('#edit-address').value,
        status_id: document.querySelector('#edit-status').value,
    };

    if (document.querySelector('#edit-password').value.trim().length > 0) {
        data = {
            ...data,
            password: document.querySelector('#edit-password').value,
            password_confirmation: document.querySelector('#edit-password-confirm').value
        };
    }

    const res = await postData(update_url, data);
    console.log(res);

    if (res.message) {
        toastr.error(res.message);
        editMode(false);
    }
    else {
        toastr.success(`${data.name} was successfully updated.`);
        editMode(false);
        loadTable(api_url);
    }

    document.querySelector('#edit-modal-close').click();
}
document.querySelector('#edit-form').addEventListener('submit', e => editRecord(e));
//////////////////////////// Edit Record /////////////////////////
//////////////////////////// Toggle Edit /////////////////////////
const editMode = (isEditing) => {
    if (isEditing) {
        document.querySelector("#edit-title").textContent = 'Edit Account';
        document.querySelector("#edit-name").disabled = false;
        document.querySelector("#edit-contact").disabled = false;
        document.querySelector("#edit-address").disabled = false;
        document.querySelector("#edit-status").disabled = false;
        document.querySelector("#edit-password").disabled = false;
        document.querySelector("#edit-password-confirm").disabled = false;
        document.querySelector("#edit-toggle-button").style.display = 'none';
        document.querySelector("#edit-cancel-button").style.display = 'block';
        document.querySelector("#edit-update-button").style.display = 'block';
    }
    else {
        document.querySelector("#edit-title").textContent = 'View Account';
        document.querySelector("#edit-password").value = '';
        document.querySelector("#edit-password-confirm").value = '';
        document.querySelector("#edit-name").disabled = true;
        document.querySelector("#edit-contact").disabled = true;
        document.querySelector("#edit-address").disabled = true;
        document.querySelector("#edit-status").disabled = true;
        document.querySelector("#edit-password").disabled = true;
        document.querySelector("#edit-password-confirm").disabled = true;
        document.querySelector("#edit-toggle-button").style.display = 'block';
        document.querySelector("#edit-cancel-button").style.display = 'none';
        document.querySelector("#edit-update-button").style.display = 'none';
    }
}
//////////////////////////// Toggle Edit /////////////////////////
//////////////////////////// View Record /////////////////////////
const showSingle = async (id) => {

    document.querySelector('#edit-created').value = '';
    document.querySelector('#edit-updated').value = '';
    document.querySelector('#edit-deleted').value = '';
    document.querySelector('#edit-id').value = '';
    document.querySelector('#edit-email').value = '';
    document.querySelector('#edit-name').value = '';
    document.querySelector('#edit-contact').value = '';
    document.querySelector('#edit-address').value = '';
    document.querySelector('#edit-type').value =  '';
    document.querySelector('#edit-role').value = '';
    document.querySelector('#edit-status').value = '';

    const show_url = `/api/v1/a/accounts/${id}`;
    const res = await getData(show_url);
    const user = res.user;

    if (res.message) {
        toastr.error(res.message);
    }
    else {
        toastr.success(`Loading ${user.name}.`);
        document.querySelector('#edit-created').value = `${parseUTC(user.created_at, true )} ${parseUTC(user.created_at, false, true )}`;
        document.querySelector('#edit-updated').value = `${parseUTC(user.updated_at, true )} ${parseUTC(user.updated_at, false, true )}`;
        document.querySelector('#edit-deleted').value = `${parseUTC(user.deleted_at, true )} ${parseUTC(user.deleted_at, false, true )}`;
        document.querySelector('#edit-id').value = user.id;
        document.querySelector('#edit-email').value = user.email;
        document.querySelector('#edit-name').value = user.name;
        document.querySelector('#edit-contact').value = user.contact;
        document.querySelector('#edit-address').value = user.address;
        document.querySelector('#edit-type').value = user.type;
        document.querySelector('#edit-role').value = user.role_id;
        document.querySelector('#edit-status').value = user.status_id;
    }
}
//////////////////////////// View Record /////////////////////////
/////////////////////////// Get Dropdown ////////////////////////
const getRoles = async () => {
    const roles = await getData('/api/v1/roles');
    if (roles.message) {
        toastr.error(roles.message);
        return;
    }
    let temp = '';
    roles.forEach(role => {
        if (role.id == 1 || role.id == 2 || role.id == 5) return;
        temp += `
            <option value="${role.id}">${role.name}</option>
        `;
    });
    document.querySelector('#add-role').innerHTML = temp;
    document.querySelector('#edit-role').innerHTML = temp;
};

//////////////////////////// Get Dropdown //////////////////////


// Load Data
getRoles();
loadTable(api_url);
search_input.addEventListener('input', e => searchUsers(api_url));
resultCount.addEventListener('change', e => loadTable(api_url));
</script>