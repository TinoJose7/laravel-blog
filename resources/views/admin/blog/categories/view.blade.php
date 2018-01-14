@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Category
            <small>View</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Category</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Category :: {{$category->name}}
                        </h3>
                        <a href="/categories" class="btn btn-primary pull-right">
                            <i class="fa fa-arrow-left"></i>
                            Category
                        </a>
                    </div>
                    <div class="box-body box-profile">
                      
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Status</b>
                                @if($category->status==0)
                                    <a class="pull-right"><span class="label label-default">InActive</span></a>
                                @else
                                    <a class="pull-right"><span class="label label-success">Active</span></a>
                                @endif                         
                            </li>
                            <li class="list-group-item">
                                <b>Name</b>
                                <a class="pull-right">{{$category->name}}</a>
                            </li>
                            <li class="list-group-item">
                                <strong>Description</strong></br>
                                </br>
                                <a>{{$category->description}}</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
