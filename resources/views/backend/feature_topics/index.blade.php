@extends('backend.layouts.master')
@section('title')
Featured Topics - Index
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
                <h3 class="mb-0">Featured Topics</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Featured Topics</li>
                  
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
                    <h3 class="card-title">Featured Topics</h3>
                        <a href="{{route('feature_topics.create')}}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Create Featured Topic</a>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    @include('backend.sessionMsg')
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Image</th>
                         
                          <th style="width: 40px">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($feature_topics as $item)
                            <tr class="align-middle">
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->name }}</td>
                          <td>{{ html_entity_decode(strip_tags($item->short_description)) }}</td>
                          <td><img src="{{ asset($item->image) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px;"></td>

                          <td>
                            <a href="{{ route('feature_topics.edit', $item->id) }}" class="btn btn-sm btn-primary mb-2" title="Edit"><i class="fas fa-edit"></i> </a>
                            <form action="{{ route('feature_topics.destroy', $item->id) }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" title="Delete" class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id }}"><i class="fas fa-trash"></i> </button>
                            </form>
                          </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No featured topics available</td>
                            </tr>
                        @endforelse
                        

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
    $('.delete-btn').on('click', function(e) {
      e.preventDefault();
      var formId = $(this).data('id');
      var form = $('#delete-form-' + formId);

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });

    $('.status-btn').on('click', function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      var message = $(this).data('message');

      Swal.fire({
        title: 'Are you sure?',
        text: "You want to " + message + "?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, proceed!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });
    });
  });
  </script>
@endsection
