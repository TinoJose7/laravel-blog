@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Blog Posts
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><i class="fa fa-newspaper-o"></i> Blog Posts</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog Posts</h3>
                        <a href="/posts/create" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i>
                            Add New
                        </a>
                    </div>
                    <div class="box-body">
                        <table id="blogPostsTable" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Categories</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blog_posts as $blog_post)
                                    <tr>
                                        <td>{{$blog_post->title}}</td>
                                        <td>
                                          @foreach($blog_post->categories as $category)
                                            <span class="label label-default">
                                                {{$category->name}}
                                            </span>&nbsp;
                                          @endforeach
                                        </td>
                                        <td>
                                            @if(!$blog_post->is_published)
                                                <span class="label label-default">Not Published</span>
                                            @else
                                                <span class="label label-success">Published</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/posts/{{$blog_post->id}}"
                                                class="btn btn-xs btn-info" title="View">
                                                <i class="fa fa-search"></i>
                                            </a>
                                            <a href="/posts/{{$blog_post->id}}/edit"
                                                class="btn btn-xs btn-primary" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            @if(!$blog_post->is_published)
                                              <a href="/posts/{{$blog_post->id}}"
                                                  class="btn btn-xs btn-success changeblogPostStatus"
                                                  data-id="{{$blog_post->id}}" title="Publish"
                                                  data-url="/posts/change-status/{{$blog_post->id}}">
                                                  <i class="fa fa-check"></i>
                                              </a>
                                            @else
                                              <a href="/posts/{{$blog_post->id}}"
                                                  class="btn btn-xs btn-danger changeblogPostStatus"
                                                  data-id="{{$blog_post->id}}" title="Unpublish"
                                                  data-url="/posts/change-status/{{$blog_post->id}}">
                                                  <i class="fa fa-ban"></i>
                                              </a>
                                            @endif
                                             <a href="/posts/{{$blog_post->id}}"
                                                class="btn btn-xs btn-danger deleteBlogPost"
                                                title="Delete" data-id="{{$blog_post->id}}"
                                                data-url="/posts/{{$blog_post->id}}">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#blogPostsTable').on('click', '.changeblogPostStatus', function(e) {
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
                                      text: "Post status changed successfully.",
                                      type: "success"
                                  }),
                                   setTimeout(function() {
                                      window.location = "/posts";
                                  }, 1400);
                              },
                              error: function( response ) {
                                  swal({
                                      title: "Oops...",
                                      text: "Something went wrong!",
                                      type: "error"
                                  }),
                                   setTimeout(function() {
                                      window.location = "/posts";
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
            $('#blogPostsTable').on('click', '.deleteBlogPost', function(e) {
                var dataId = $(this).attr('data-id'),
                    url = $(this).attr('data-url')

                    swal({
                      title: "Are you sure?",
                      text: "You will not be able to recover this service!",
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
                                  if ( response.status === 'success' ) {
                                      swal({
                                          title: "Deleted!",
                                          text: "Post deleted successfully.",
                                          type: "success"
                                      }),
                                       setTimeout(function() {
                                          window.location = "/posts";
                                      }, 1400);
                                  }
                              },
                              error: function( response ) {
                                  if ( response.status === 422 ) {
                                      swal({
                                          title: "Oops...",
                                          text: "Something went wrong!",
                                          type: "error"
                                      }),
                                       setTimeout(function() {
                                          window.location = "/posts";
                                      }, 1400);
                                  }
                              }
                          });

                      } else {
                          swal({
                              title: "Cancelled",
                              text: "The post is safe :)",
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
