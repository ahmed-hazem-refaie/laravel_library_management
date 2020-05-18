<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use App\UserBook;
use App\UserFavourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $userBooks = User::find(Auth::id())->books()->get();
//        $userFavourites = User::find(Auth::id())->bookFavorite()->pluck("book_id")->all();
//        dd($userBooks,$userFavourites);
        return view("userBooks.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserBook  $userBook
     * @return \Illuminate\Http\Response
     */
    public function show(UserBook $userBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserBook  $userBook
     * @return \Illuminate\Http\Response
     */
    public function edit(UserBook $userBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserBook  $userBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserBook $userBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserBook  $userBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserBook $userBook)
    {
        //
    }
}
