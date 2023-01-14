<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLog;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $rentLogCount = RentLog::count();
        $rentLog = RentLog::all();

        $data = [
            'book_count' => $bookCount,
            'category_count' => $categoryCount,
            'user_count' => $userCount,
            'rent_log_count' => $rentLogCount,
            'rent_logs' => $rentLog
        ];

        return view('dashboard', ['data' => $data]);
    }
}
