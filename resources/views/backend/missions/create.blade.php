@extends('backend.layouts.master')
@section('title')
Mission - Create
@endsection
@section('content')

    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Mission - Form</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Mission - Form</li>
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
            <div class="row g-4">
              <!--begin::Col-->
              <div class="col-12">

              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-md-12">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header">
                    <div class="card-title">Create a mission</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('missions.store') }}" method="post" enctype="multipart/form-data">
                    @include('backend.sessionMsg')
                    @csrf
                    @include('backend.missions.form')
                  </form>
                  <!--end::Form-->
                </div>
                <!--end::Quick Example-->
                <!--begin::Input Group-->

                <!--end::Horizontal Form-->
              </div>
              <!--end::Col-->
              <!--begin::Col-->
      
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>

    <!-- Main content -->

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>



    <script>
    
        CKEDITOR.replace( 'description' );

    </script>
    
@endsection
