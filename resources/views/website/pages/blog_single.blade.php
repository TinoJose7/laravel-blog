@extends('website.layouts.master')
@section('content')
    <header id=header class="home-parallax home-fade dark-bg header-inner">
        <div class=color-overlay></div>
        <div class=container>
            <h3>{{ $blog_post->title }}</h3>
            <div class=breadcrumb>
                <a href="/">Blogs</a>
            </div>
        </div>
    </header>
    <section id=blog-standard class="section blog-standard">
        <div class=container>
            <div class=col-md-8>
                <div class="row blog-post">
                    <div class=col-md-12>
                        <div class=featured-image>
                            @if( !$blog_post->image )
                                <img src="/storage/images/blog/posts/730x300/default.png"
                                    class=img-responsive alt="Default Image">
                            @else
                                <img src="/storage/images/blog/posts/730x300/{{$blog_post->image}}"
                                    class=img-responsive alt="Post Image">
                            @endif
                        </div>
                        <h2 class=post-title>
                            <a href="#">
                                {{ $blog_post->title }}
                            </a>
                        </h2>
                        <div class=post-meta>
                            by <a href=#>Admin</a> <span>|</span>
                            <a href=#>{{ $blog_post->created_at->format('d M') }}</a>
                            <span>|</span>
                            @foreach ($blog_post->categories as $blog_post_category)
                                <a href="/blog-category/{{$blog_post_category->id}}">
                                    {{ $blog_post_category->name }}
                                </a>
                            @endforeach
                        </div>
                        <div class=post-content>
                            {!! $blog_post->description !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-0">
                <div class="sidebar hidden-sm hidden-xs">
                    {{-- <div class=widget>
                        <form><input type=text placeholder=Search... class=form-control></form>
                    </div> --}}
                    <div class="widget popular-posts">
                        <div class=widget-title>
                            <h4>Recent posts</h4>
                        </div>
                        <div class=widget-content>
                            <ul>
                                @foreach ($blog_posts_recent as $blog_post_recent)
                                    <li class=clearfix>
                                        <a href="/blog/{{$blog_post_recent->id}}" class="pull-left thumb">
                                            @if(!$blog_post_recent->image)
                                                <img src="/storage/images/blog/posts/69x69/default.png"
                                                    alt="Default Image">
                                            @else
                                                <img src="/storage/images/blog/posts/69x69/{{$blog_post_recent->image}}"
                                                    alt="Blog Image">
                                            @endif
                                        </a>
                                        <a href="/blog/{{$blog_post_recent->id}}" class=title>{{$blog_post_recent->title}}</a>
                                        <div class=date>{{$blog_post_recent->created_at->format('d M Y')}}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="widget categories">
                        <div class=widget-title>
                            <h4>Categories</h4>
                        </div>
                        <div class=widget-content>
                            <ul>
                                @foreach ($blog_categories as $blog_category)
                                    <li>
                                        <a href="/blog-category/{{$blog_category->id}}">
                                            {{ $blog_category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
