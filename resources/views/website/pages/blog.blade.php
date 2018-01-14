@extends('website.layouts.master')
@section('content')
    <header id=header class="home-parallax home-fade dark-bg header-inner">
        <div class=color-overlay></div>
        <div class=container>
            <h3>Blog</h3>
            <div class=breadcrumb>
                <a href="/">Home</a> <i class="fa fa-angle-double-right"></i>
                <a href=#>Blog</a>
            </div>
        </div>
    </header>
    <section id=blog-standard class="section blog-standard">
        <div class=container>
            <div class=col-md-8>
                @foreach ($blog_posts as $blog_post)
                    <div class="row blog-post">
                        <div class=col-md-12>
                            <div class=featured-image>
                                @if( !$blog_post->image )
                                    <a href="/blog/{{$blog_post->id}}">
                                        <img src="/storage/images/blog/posts/730x300/default.png"
                                            class=img-responsive alt="Default Image">
                                    </a>
                                @else
                                    <a href="/blog/{{$blog_post->id}}">
                                        <img src="/storage/images/blog/posts/730x300/{{$blog_post->image}}"
                                            class=img-responsive alt="Post Image">
                                    </a>
                                @endif
                            </div>
                            <h2 class=post-title>
                                <a href="/blog/{{$blog_post->id}}">
                                    {{ $blog_post->title }}
                                </a>
                            </h2>
                            <div class=post-meta>
                                by <a href=#>Admin</a> <span>|</span>
                                <a href=#>{{ $blog_post->created_at->format('d M') }}</a>
                                <span>|</span>
                                <a href="/blog-category/{{$blog_post->blog_category->id}}">
                                    {{ $blog_post->blog_category->name }}
                                </a>
                            </div>
                            <div class=post-content>
                                {!! str_limit($blog_post->description, 200) !!}
                            </div>
                            <div class=read-more>
                                <a href="/blog/{{$blog_post->id}}">
                                    <i class="fa fa-angle-double-right"></i>
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if($blog_posts->isEmpty())
                    <div class="row blog-post">
                        <div class=col-md-12>
                            <h2 class="post-title text-center">
                                <a href="#">
                                    No Post Found.
                                </a>
                            </h2>
                        </div>
                    </div>
                @endif
                <nav>
                    {{ $blog_posts->links() }}
                    {{-- <ul class="pagination pagination-lg">
                        <li><a href=# aria-label=Previous><span aria-hidden=true>&laquo;</span></a></li>
                        <li class=active><a href=#>1</a></li>
                        <li><a href=#>2</a></li>
                        <li><a href=#>3</a></li>
                        <li><a href=#>4</a></li>
                        <li><a href=#>5</a></li>
                        <li>
                            <a href=# aria-label=Next>
                                <span aria-hidden=true>&raquo;</span>
                            </a>
                        </li>
                    </ul> --}}
                </nav>
            </div>
            <div class="col-md-4 col-md-offset-0">
                <div class="sidebar hidden-sm hidden-xs">
                    {{-- <div class=widget>
                        <form><input type=text placeholder=Search... class=form-control></form>
                    </div> --}}
                    <div class="widget popular-posts">
                        @if(!$blog_posts->isEmpty())
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
                        @endif
                    </div>

                    <div class="widget categories">
                        @if(!$blog_posts->isEmpty())
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
