@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Blog Post
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Blog Posts</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Post</h3>
                        <a href="/posts" class="btn btn-primary pull-right">
                            <i class="fa fa-arrow-left"></i>
                            Blog Posts
                        </a>
                    </div>
                    <form  id="formUpdateBlogPost" name="formUpdateBlogPost"
                        action="/posts/{{$post->id}}" method="POST"
                        role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">
                            <div class="form-group">
                                <label>
                                    Title
                                    <span class="asteric-mandatory">*</span>
                                </label>
                                <input class="form-control" id="title" name="title"
                                    placeholder="eg: Award function held on 21/09/2017"
                                    type="text" value="{{$post->title}}" required>
                            </div>
                            <div class="form-group">
                                <label>Blog Category
                                    <span class="asteric-mandatory">*</span>
                                </label>

                                <select class="form-control select2" multiple="multiple"    data-placeholder="Select a State" style="width: 100%;"
                                    id="category_id" name="category_id[]" required>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}"
                                            @foreach($post->categories as $post_category)
                                                {{ ($category->id == $post_category->id)? 'selected': '' }}
                                            @endforeach
                                        >
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <span>
                                    @if(!$post->image)
                                        <img class="img-responsive blog-post-edit-image"
                                            src="/storage/images/blog/posts/730x300/default.png"
                                            alt="Post Image">
                                    @else
                                        <img class="img-responsive blog-post-edit-image"
                                            src="/storage/images/blog/posts/730x300/{{$post->image}}"
                                            alt="Post Image">
                                    @endif
                                </span>
                                <label>
                                    Change Image
                                </label>
                                <input type="file" name="image" id="image"
                                    class="form-control" placeholder="Image"
                                    accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="form_control_1">Description
                                    <span class="asteric-mandatory">*</span>
                                </label>
                                <textarea id="summernote"
                                    class="form-control input-sm" rows="10"
                                    name="description"
                                    required>{!!$post->description!!}</textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"
                                id="btnUpdate"> Update</button>
                            <a href="/posts" class="btn btn-default">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#formUpdateBlogPost').submit(function(e) {
                e.preventDefault();
                btn = $(this).find('#btnUpdate');
                btn.html('Update <i class="fa fa-spinner fa-spin"></i>');
                btn.prop('disabled',true);
                data = new FormData(this);
                url = $(this).attr("action");
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        btn.html('Update');
                        btn.prop('disabled',false);
                        setTimeout(function() {
                            swal({
                                title: "Success!",
                                text: "Post details updated successfully.",
                                type: "success"
                            }, function() {
                                window.location = "/posts";
                            });
                        });

                    },
                    error: function(e) {
                        btn.html('Update');
                        btn.prop('disabled',false);
                        setTimeout(function() {
                            swal({
                                title: "Oops...",
                                text: "Something went wrong!",
                                type: "error"
                            }, function() {
                                // window.location = "/posts";
                            });
                        });
                    }
                });
            });

            $('#summernote').summernote({
               shortcuts: false,
               minHeight: 200 ,
               toolbar: [],
               callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
           });
        });
    </script>
@endpush
