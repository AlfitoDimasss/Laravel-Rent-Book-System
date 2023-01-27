<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentLogController extends Controller
{
    public function index()
    {
        $rentLog = RentLog::where('user_id', Auth::user()->id)->get();
        return view('rent-logs', ['rentLogs' => $rentLog]);
    }

    public function create()
    {
        $users = User::where('role_id', 2)->get();
        $books = Book::where('stock', '>', 0)->get();
        return view('form.add-rent-form', ['users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
        $rentLog = '';
        if (Auth::user()->role_id == 1) {
            $rentLog = RentLog::create([
                'user_id' => $request['user'],
                'book_id' => $request['book'],
                'rent_date' => Carbon::now(),
                'return_date' => Carbon::now()->addDay(3),
                'status' => 'borrowed'
            ]);
            $book = Book::where('id', $request['book'])->first();
            $book->update([
                'stock' => $book->stock - 1
            ]);
            if ($rentLog) {
                return redirect('/dashboard')->with(['success' => 'Success Add New Rent Data']);
            } else {
                return redirect('/dashboard')->with(['failed' => 'Failed Add New Rent Data']);
            }
        } else {
            $rentLog = RentLog::create([
                'user_id' => $request['user'],
                'book_id' => $request['book'],
                'status' => 'in progress'
            ]);
            $book = Book::where('id', $request['book'])->first();
            $book->update([
                'stock' => $book->stock - 1
            ]);
            if ($rentLog) {
                return redirect('/rent-logs')->with(['success' => 'Success Add New Rent Data']);
            } else {
                return redirect('/rent-logs')->with(['failed' => 'Failed Add New Rent Data']);
            }
        }
    }

    public function borrow($id)
    {
        $rentLog = RentLog::where('id', $id)->first();
        $rentLog->update([
            'rent_date' => Carbon::now(),
            'return_date' => Carbon::now()->addDay(3),
            'status' => 'borrowed'
        ]);
        if ($rentLog) {
            return redirect('/dashboard')->with(['success' => 'Success Change Status']);
        } else {
            return redirect('/dashboard')->with(['failed' => 'Failed Change Status']);
        }
    }

    public function return($id)
    {
        $rentLog = RentLog::where('id', $id)->first();
        $rentLog->update([
            'actual_return_date' => Carbon::now(),
            'status' => 'returned'
        ]);
        if ($rentLog) {
            return redirect('/dashboard')->with(['success' => 'Success Change Status']);
        } else {
            return redirect('/dashboard')->with(['failed' => 'Failed Change Status']);
        }
    }
}
