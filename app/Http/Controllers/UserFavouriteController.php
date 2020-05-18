<?php

namespace App\Http\Controllers;

use App\User;
use App\UserFavourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userFavourites = User::find(Auth::id())->bookFavorite()->get();
//        dd($userFavourites);
        return view("userFavourites.index",["userFavourites" => $userFavourites]);
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
     * @param  \App\UserFavourite  $userFavourite
     * @return \Illuminate\Http\Response
     */
    public function show(UserFavourite $userFavourite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserFavourite  $userFavourite
     * @return \Illuminate\Http\Response
     */
    public function edit(UserFavourite $userFavourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserFavourite  $userFavourite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserFavourite $userFavourite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserFavourite  $userFavourite
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserFavourite $userFavourite)
    {
        //
    }
}
