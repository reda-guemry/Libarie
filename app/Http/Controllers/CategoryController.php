<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorUpdateyRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('books')->get() ;
        return response()->json([
            'categories' => CategoryResource::collection($categories)
        ]) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name , 
        ]) ;

        return response()->json([
            'message' => 'Category created successfully' ,
            'category' => new CategoryResource($category) ,
        ] , 201) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'category' => new CategoryResource($category)
        ] , 200) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategorUpdateyRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name ,
        ]) ;

        return response()->json([
            'message' => 'Category updated successfully' ,
            'category' => new CategoryResource($category) ,
        ] , 200) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete() ;

        return response()->json([
            'message' => 'Category deleted successfully' ,
        ] , 200) ;
    }
}
