<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        return response()->json($books);
    }

    public function getAllAuthors(){
        $authors = Book::select('Author')
            ->distinct()
            ->orderBy('Author')
            ->get();

        $arr=[];
        foreach($authors as $key => $value){
            $arr[] = $value->Author;
        }
        return response()->json($arr);
    }

    public function bookByAuthor($authorName){
        $filteredBooks = Book::where('Author','=',$authorName)->get();
        if (count($filteredBooks) == 0){
            return response()->json(
            [
                'message' => 'No data!'
            ],404);
        }
        return response()->json($filteredBooks);
    }

    function randomBooks($count){
        $books = Book::orderByRaw('rand()')
            ->limit($count)
            ->get();
        return response()->json($books);
    }
}
