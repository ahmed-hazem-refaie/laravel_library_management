<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class MyBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = User::find($request->user_id)->books()->get();
        $userFavourites = User::find($request->user_id)->bookFavorite()->pluck("book_id")->all();
        return response()->json(['books' => $books,'userFavourites' => $userFavourites]);
    }
    public function makeLikeMyBooks(Request $request)
    {
        User::find($request->user_id)->bookFavorite()->toggle($request->book_id);
        return response()->json(true);
    }

}
