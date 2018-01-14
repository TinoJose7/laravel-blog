@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Categories
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><i class="fa fa-graduation-cap"></i>Categories</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Categories</h3>
                        <a href="categories/create" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i>
                            Add New
                        </a>
                    </div>
                    <div class="box-body">
                        <table id="categoryTable" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($blog_categories as $category)

                                    <tr>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            @if($category->status)
                                               <span class="label label-success">Active</span>
                                            @else
                                              <span class="label label-default">InActive</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="/categories/{{$category->id}}"
                                                class="btn btn-xs btn-info" title="View">
                                                <i class="fa fa-search"></i>
                                            </a>


                                            <a href="/categories/{{$category->id}}/edit"
                                                class="btn btn-xs btn-primary" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                             <a href="/categories/{{$category->id}}"
                                                class="btn btn-xs btn-danger deleteCategory" title="Edit" data-id="{{$category->id}}" title="Delete"  data-url="/categories/{{$category->id}}">
                                                <i class="fa fa-trash-o"></i>
                                            </a>

                                            @if(!$category->status)

                                                  <a href="/categories/{{$category->id}}"
                                                  class="btn btn-xs btn-success changeCategoryStatus" data-id="{{$category->id}}" title="Enable" data-url="/categories/change-status/{{$category->id}}">
                                                  <i class="fa fa-check"></i>
                                                  </a>
                                            @else

                                                  <a href="/categories/{{$category->id}}"
                                                  class="btn btn-xs btn-danger changeCategoryStatus" data-id="{{$category->id}}" title="Disable"  data-url="/categories/change-status/{{$category->id}}">
                                                  <i class="fa fa-ban"></i>
                                                  </a>
                                            @endif


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#categoryTable').on('click', '.changeCategoryStatus', function(e) {
                var dataId = $(this).attr('data-id'),
                    url = $(this).attr('data-url')

                    swal({
                      title: "Are you sure?",
                      text: "You are able to revert this operation!",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Yes, change status!",
                      cancelButtonText: "No, cancel please!",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    },
                    function(isConfirm){
                      if (isConfirm) {

                          $.ajax({
                              url: url,
                              type: 'GET',
                              data : {'_token': '{!! csrf_token() !!}'},
                              dataType:"json",
                              success: function( response ) {
                                  swal({
                                      title: "Status Changed!",
                                      text: "Category status changed successfully.",
                                      type: "success"
                                  }),
                                   setTimeout(function() {
                                      window.location = "/categories";
                                  }, 1400);
                              },
                              error: function( response ) {
                                  swal({
                                      title: "Oops...",
                                      text: "Something went wrong!",
                                      type: "error"
                                  }),
                                   setTimeout(function() {
                                      window.location = "/categories";
                                  }, 1400);
                              }
                          });

                      } else {
                          swal({
                              title: "Cancelled",
                            //   text: "The service is safe :)",
                              type: "error"
                          });
                        //    setTimeout(function() {
                        //       window.location = "/services";
                        //   }, 1400);
                      }
                    });
                return false;
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#categoryTable').on('click', '.deleteCategory', function(e) {
                var dataId = $(this).attr('data-id'),
                    url = $(this).attr('data-url')
                    swal({
                      title: "Are you sure?",
                      text: "You will not be able to recover this Category!",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Yes, delete it!",
                      cancelButtonText: "No, cancel please!",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    },
                    function(isConfirm){
                      if (isConfirm) {

                          $.ajax({
                              url: url,
                              type: 'DELETE',
                              data : {'_token': '{!! csrf_token() !!}'},
                              dataType:"json",
                              success: function( response ) {
                                  swal({
                                      title: response.title,
                                      text: response.message,
                                      type: response.status
                                  }),
                                  setTimeout(function() {
                                      window.location = "/categories";
                                  }, 1400);
                              },
                              error: function( response ) {
                                  swal({
                                      title: response.responseJSON.title,
                                      text: response.responseJSON.message,
                                      type: response.responseJSON.status
                                  });
                                  setTimeout(function() {
                                      window.location = "/categories";
                                  }, 1400);
                              }
                          });

                      } else {
                          swal({
                              title: "Cancelled",
                              text: "The category is safe :)",
                              type: "error"
                          });
                        //    setTimeout(function() {
                        //       window.location = "/services";
                        //   }, 1400);
                      }
                    });
                return false;
            });
        });
    </script>
@endpush
