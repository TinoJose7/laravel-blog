<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Category;
use Illuminate\Http\Request;
// use Yajra\Datatables\Datatables;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryStatusRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blog.categories.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories()
    {
        $categories = Category::select(['id', 'name', 'status', 'created_at', 'updated_at'])->latest()->get();

        return DataTables::of($categories)
            ->addColumn('status', function ($category) {
                return $category->isActive() ? '<span class="label label-success">Active</span>' : '<span class="label label-default">InActive</span>'; 
            })
            ->addColumn('actions', function ($category) {
                return $category->actionButtons();
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        return response()->json($request->handle());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.blog.categories.view', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.blog.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request , Category $category)
    {
        return response()->json($request->handle($category));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(!$category->status && $category->posts->count() < 1) {
            $destroy = $category->delete();
            if($destroy) {
                return response()->json([
                    'status' => 'success',
                    'title' => 'Deleted!',
                    'message' => 'Something went wrong!'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'title' => 'Oops...',
                    'message' => 'Something went wrong!'
                ], 422);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'title' => 'Can\'t delete!',
                'message' => 'This category is in use.You Cant delete  !'
            ], 422);
        }
    }

    /**
     * Update the specified status in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(UpdateCategoryStatusRequest $request,Category $category)
    {
        return response()->json($request->handle($category));
    }
}
