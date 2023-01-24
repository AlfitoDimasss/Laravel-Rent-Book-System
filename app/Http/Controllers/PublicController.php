<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $topBooks = Book::where('rating', 5)->take(8)->get();
        $latestBooks = Book::orderBy('updated_at', 'asc')->take(8)->get();
        return view('public.main-books', ['topBooks' => $topBooks, 'latestBooks' => $latestBooks]);
    }

    public function all()
    {
        $books = Book::all();
        return view('public.all-books', ['books' => $books]);
    }
}
