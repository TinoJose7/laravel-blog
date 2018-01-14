<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
    	$blog_categories = Category::where('status', 1)->get();
        $blog_posts = Post::where('is_published', 1)->latest()->paginate(2);
        $blog_posts_recent = Post::where('is_published', 1)->latest()->limit(4)->get();

        return view('website.home', compact('blog_posts', 'blog_posts_recent',
            'blog_categories'));
    }

    public function blogCategory(Category $blog_category)
    {
        $blog_posts = $blog_category->posts()->where('is_published', 1)
        	->latest()->paginate(2);
        $blog_categories = Category::where('status', 1)->get();
        $blog_posts_recent = Post::where('is_published', 1)->latest()->limit(4)->get();

        return view('website.home', compact('blog_posts', 'blog_posts_recent',
            'blog_categories'));
    }

    public function singleBlog(Post $blog_post)
    {
        $blog_categories = Category::where('status', 1)->get();
        $blog_posts_recent = Post::where('is_published', 1)->latest()->limit(4)->get();

        return view('website.pages.blog_single', compact('blog_post', 'blog_posts_recent',
            'blog_categories'));
    }
}
