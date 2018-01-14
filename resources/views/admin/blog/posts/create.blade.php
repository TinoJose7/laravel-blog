@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Blog Posts
            <small>Create</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Blog Posts</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create New Post</h3>
                        <a href="/posts" class="btn btn-primary pull-right">
                            <i class="fa fa-arrow-left"></i>
                            Blog Posts
                        </a>
                    </div>
                    <form  id="formStoreBlogPost" name="formStoreBlogPost"
                        action="/posts" method="POST"
                        role="form">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label>
                                    Title
                                    <span class="asteric-mandatory">*</span>
                                </label>
                                <input class="form-control" id="title" name="title"
                                    placeholder="eg: Award function held on 21/09/2017" type="text" required>
                            </div>
                            <div class="form-group">
                                <label>
                                    Blog Category
                                    <span class="asteric-mandatory">*</span>
                                </label>
                                <select class="form-control select2" multiple="multiple"    data-placeholder="Select a State" style="width: 100%;"
                                    id="category_id" name="category_id[]" required>
                                    <option value="">--Select--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">
                                         {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Image
                                    <span class="asteric-mandatory">*</span>
                                </label>
                                <input type="file" name="image" id="image"
                                    class="form-control" placeholder="Image"
                                    accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="form_control_1">Description
                                    <span class="asteric-mandatory">*</span>
                                </label>
                                <textarea id="summernote" class="form-control input-sm" rows="10"
                                    name="description" required></textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success"
                                id="btnCreate"> Create</button>
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
            $('#formStoreBlogPost').submit(function(e) {
                e.preventDefault();
                btn = $(this).find('#btnCreate');
                btn.html('Create <i class="fa fa-spinner fa-spin"></i>');
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
                        btn.html('Create');
                        btn.prop('disabled',false);
                        setTimeout(function() {
                            swal({
                                title: "Success!",
                                text: "Post created successfully.",
                                type: "success"
                            }, function() {
                                window.location = "/posts";
                            });
                        });

                    },
                    error: function(e) {
                        btn.html('Create');
                        btn.prop('disabled',false);
                        setTimeout(function() {
                            swal({
                                title: "Oops...",
                                text: "Something went wrong!",
                                type: "error"
                            }, function() {
                                // window.location = "/candidates";
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
