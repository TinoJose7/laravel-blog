@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Blog Post
            <small>View</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Blog Posts</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            View Post
                        </h3>
                        <a href="/posts" class="btn btn-primary pull-right">
                            <i class="fa fa-arrow-left"></i>
                            Blog Posts
                        </a>
                    </div>
                    <div class="box-body box-profile">
                        @if(!$post->image)
                            <img class="profile-user-img img-responsive blog-post-view-image"
                                src="/storage/images/blog/posts/730x300/default.png"
                                alt="Post Image">
                        @else
                            <img class="profile-user-img img-responsive blog-post-view-image"
                                src="/storage/images/blog/posts/730x300/{{$post->image}}"
                                alt="Post Image">
                        @endif

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item view-first-item">
                                <strong>Title</strong></br>
                                <a>{{$post->title}}</a>
                            </li>
                            <li class="list-group-item">
                                <strong>Blog Categories</strong>
                                <a class="pull-right">
                                    @foreach($post->categories as $category)
                                        <span class="label label-default">
                                            {{$category->name}}
                                        </span>&nbsp;
                                    @endforeach
                                </a>
                            </li>
                            <li class="list-group-item">
                                <strong>Description</strong></br>
                                <a>{!! $post->description !!}</a>
                            </li>
                            <li class="list-group-item">
                                <strong>Status</strong>
                                <a class="pull-right">
                                    @if(!$post->is_published)
                                        <span class="label label-default pull-right">Not Published</span>
                                    @else
                                        <span class="label label-success pull-right">Published</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
