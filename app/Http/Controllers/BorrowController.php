<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BorrowController extends Controller
{

    public function emprunter(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);

        if ($book->available_copies < 1) {
            return response()->json(['message' => 'No copies available for borrowing.'], 400);
        }

        $dejaEmprunte = $book->borrows()->where('user_id', $request->user()->id)->where('status', 'en cours')->exists();

        if ($dejaEmprunte) {
            return response()->json(['message' => 'You have already borrowed this book.'], 400);
        }

        $brrow = $book->borrows()->create([
            'user_id' => $request->user()->id,
            'borrowed_at' => now(),
            'status' => 'en cours',
        ]);

        return response()->json([
            'message' => 'Book borrowed successfully.', 'borrow' => $brrow
        ], 201);

    }

    public function retourner(Request $request, $borrowId)
    {
        $borrow = Borrow::findOrFail($borrowId);

        if ($borrow->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        if ($borrow->status === 'returned') {
            return response()->json(['message' => 'This book has already been returned.'], 400);
        }

        $borrow->update([
            'returned_at' => now(),
            'status' => 'returned',
        ]);

        return response()->json(['message' => 'Book returned successfully.'], 200);
    }

}
