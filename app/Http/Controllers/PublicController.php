<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        if ($request['title']) {
            $resultBooks = Book::where('title', 'like', '%' . $request['title'] . '%')->get();
            return view('public.main-books', ['resultBooks' => $resultBooks]);
        } else {
            $topBooks = Book::where('rating', 5)->take(8)->get();
            $latestBooks = Book::orderBy('updated_at', 'desc')->take(8)->get();
            return view('public.main-books', ['topBooks' => $topBooks, 'latestBooks' => $latestBooks]);
        }
    }

    public function all()
    {
        $books = Book::all();
        return view('public.all-books', ['books' => $books]);
    }
}
