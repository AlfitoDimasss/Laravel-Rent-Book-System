<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books', ['books' => $books]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('form.add-book-form', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'book_code' => 'required|unique:books',
            'title' => 'required'
        ]);

        $book = '';

        if ($request->file('cover')) {
            $ext = $request->file('cover')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $ext;
            $request->file('cover')->storeAs('cover', $newName);
            $book = Book::create([
                'book_code' => $request['book_code'],
                'title' => $request['title'],
                'cover' => $newName
            ]);
        } else {
            $book = Book::create([
                'book_code' => $request['book_code'],
                'title' => $request['title']
            ]);
        }


        $book->categories()->sync($request['category']);

        if ($book) {
            return redirect('/books')->with(['success' => 'Success Add New Category']);
        } else {
            return redirect('/books')->with(['failed' => 'Success Add New Category']);
        }
    }
}
