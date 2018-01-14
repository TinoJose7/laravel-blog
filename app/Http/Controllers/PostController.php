<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\Post\UpdatePostStatusRequest;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_posts = Post::latest()->get();

        return view('admin.blog.posts.index', compact('blog_posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();

        return view('admin.blog.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        return response()->json($request->handle());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.blog.posts.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::where('status', 1)->get();

        return view('admin.blog.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        return response()->json($request->handle($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $destroy = $post->delete();

        if($destroy) {
            if( $post->image != NULL) {
                $isImageExistsInPath1 = file_exists( storage_path() . '/app/public/images/blog/posts/69x69/' . $post->image );
                if($isImageExistsInPath1) {
                    $path = storage_path('app/public/images/blog/posts/69x69/' . $post->image);
                    $delete = \File::delete($path);
                }
                $isImageExistsInPath2 = file_exists( storage_path() . '/app/public/images/blog/posts/730x300/' . $post->image );
                if($isImageExistsInPath2) {
                    $path = storage_path('app/public/images/blog/posts/730x300/' . $post->image);
                    $delete = \File::delete($path);
                }
            }
            return response()->json([
                'status' => 'success'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error'
            ], 422);
        }
    }

    public function changeStatus(UpdatePostStatusRequest $request,Post $post)
    {
        return response()->json($request->handle($post));
    }
}
