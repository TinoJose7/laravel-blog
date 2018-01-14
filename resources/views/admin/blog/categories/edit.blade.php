@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Category
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Categories</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Category :: {{$category->name}}</h3>
                        <a href="/categories" class="btn btn-primary pull-right">
                            <i class="fa fa-arrow-left"></i>
                            Categories
                        </a>
                    </div>
                    <form  id="formUpdateCategory" name="formUpdateCategory"
                        action="/categories/{{$category->id}}" method="POST"
                        role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label>
                                    Name of the Category
                                    <span class="asteric-mandatory">*</span>
                                </label>
                                <input class="form-control" id="name" name="name"
                                    placeholder="eg: John Doe" type="text"
                                    value="{{$category->name}}" required>
                            </div>

                            <div class="form-group">
                                <label>Description
                                </label>
                                <textarea class="form-control" id="description"
                                    name="description" placeholder="Enter your permanent address"
                                    rows="5">{{$category->description}}</textarea>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary"
                                    id="btnUpdate"> Update</button>
                                <a href="/categories" class="btn btn-default">Cancel</a>
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
            $('#formUpdateCategory').submit(function(e) {
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
                                text: "Category details updated successfully.",
                                type: "success"
                            }, function() {
                                window.location = "/categories";
                            });
                        });

                    },
                    error: function(e) {
                        alert(e);
                        btn.html('Update');
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
        });
    </script>
@endpush
