<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $books = Book::all();
//        $userFavourites = User::find(Auth::id())->bookFavorite()->pluck("book_id")->all();
        return view('home.index');
    }
}
