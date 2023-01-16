<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
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
        $request->validate([
            'book_code' => 'required|unique:books',
            'title' => 'required'
        ]);

        $book = '';

        if ($request->file('cover')) {
            $ext = $request->file('cover')->getClientOriginalExtension();
            $newCoverName = $request->title . '-' . now()->timestamp . '.' . $ext;
            $request->file('cover')->storeAs('cover', $newCoverName);
            $book = Book::create([
                'book_code' => $request['book_code'],
                'title' => $request['title'],
                'cover' => $newCoverName
            ]);
        } else {
            $book = Book::create([
                'book_code' => $request['book_code'],
                'title' => $request['title']
            ]);
        }


        $res = $book->categories()->sync($request['category']);

        if ($res) {
            return redirect('/books')->with(['success' => 'Success Add New Book']);
        } else {
            return redirect('/books')->with(['failed' => 'Success Add New Book']);
        }
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('form.edit-book-form', ['categories' => $categories, 'book' => $book]);
    }

    public function update(Request $request, $slug)
    {
        $newCoverName = '';
        $newCategory = '';
        $book = Book::where('slug', $slug)->first();
        if ($request->file('cover')) {
            $ext = $request->file('cover')->getClientOriginalExtension();
            $newCoverName = $request->title . '-' . now()->timestamp . '.' . $ext;
            $request->file('cover')->storeAs('cover', $newCoverName);
            $book->update([
                'cover' => $newCoverName
            ]);
        }

        if ($request['category']) {
            $newCategory = $request['category'];
            $book->categories()->sync($newCategory);
        }

        if ($request['old_book_code'] != $request['book_code']) {
            $book->update([
                'book_code' => $request['book_code']
            ]);
        }

        $res = $book->update([
            'title' => $request['title']
        ]);

        if ($res) {
            return redirect('/books')->with(['success' => 'Success Update Book']);
        } else {
            return redirect('/books')->with(['failed' => 'Failed Update Book']);
        }
    }

    public function destroy($slug)
    {
        $book = Book::where('slug', $slug)->first();
        if ($book->rentLogs()->exists()) {
            return redirect('/books')->with(['failed' => 'Failed to delete book, because the book data is used by another table.']);
        } else {
            $bookCategories = BookCategory::where('book_id', $book->id)->get();
            foreach ($bookCategories as $bookCategory) {
                $bookCategory->delete();
            }
            $res = $book->delete();
            if ($res) {
                return redirect('/books')->with(['success' => 'Success Delete Book']);
            } else {
                return redirect('/books')->with(['failed' => 'Failed Delete Book']);
            }
        }
    }
}
