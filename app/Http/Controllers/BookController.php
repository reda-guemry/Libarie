<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->get() ;
        return response()->json([
            'books' => BookResource::collection($books)
        ], 200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated()) ;
        return response()->json([
            'message' => 'Book created successfully',
            'book' => new BookResource($book)
        ], 201) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->increment('views');

        return response()->json([
            'book' => new BookResource($book)
        ], 200) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return response()->json([
            'message' => 'Book updated successfully',
            'book' => new BookResource($book)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }
}
