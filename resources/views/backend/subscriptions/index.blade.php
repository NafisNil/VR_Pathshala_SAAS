@extends('backend.layouts.master')
@section('title')
Subscription - Index
@endsection
@section('content')

 
    <!-- Main content -->
         <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Subscription</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Subscription</li>
                  
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Subscription</h3>
                       
                  </div>
                  <!-- Filter section -->
                  <div class="card-body border-bottom">
                    <form id="filter-form" class="row g-3">
                      <div class="col-md-4">
                        <input type="text" name="username" id="filter-username" class="form-control" placeholder="Filter by User Name">
                      </div>
                      <div class="col-md-4">
                        <select name="status" id="filter-status" class="form-select">
                          <option value="">All Statuses</option>
                          <option value="active">Active</option>
                          <option value="inactive">Inactive</option>
                          <option value="cancelled">Cancelled</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <button type="button" id="reset-filter" class="btn btn-secondary">Reset</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    @include('backend.sessionMsg')
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>User Name</th>
                          <th>Plan Name</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Price</th>
                          <th>Status</th>
                          <th style="width: 40px">Actions</th>
                        </tr>
                      </thead>
                      <tbody id="subscription-table-body">
                        @include('backend.subscriptions.partials.subscription_table')
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  {{-- <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                      <li class="page-item">
                        <a class="page-link" href="#">&laquo;</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">&raquo;</a>
                      </li>
                    </ul>
                  </div> --}}
                </div>
                <!-- /.card -->

                <!-- /.card -->
              </div>
              <!-- /.col -->
             
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
      function fetchSubscriptions() {
        $.ajax({
          url: "{{ route('subscriptions.index') }}",
          type: "GET",
          data: {
            username: $('#filter-username').val(),
            status: $('#filter-status').val()
          },
          success: function(response) {
            $('#subscription-table-body').html(response);
          }
        });
      }

      $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        fetchSubscriptions();
      });

      $('#filter-username, #filter-status').on('keyup change', function() {
        fetchSubscriptions();
      });

      $('#reset-filter').on('click', function() {
        $('#filter-form')[0].reset();
        fetchSubscriptions();
      });
    });
    </script>
@endsection
