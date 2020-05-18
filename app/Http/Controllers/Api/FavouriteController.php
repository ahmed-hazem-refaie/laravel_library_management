<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = User::find($request->user_id)->bookFavorite()->get();
//        dd($userBooks,$userFavourites);
        return response()->json(['books' => $books]);
    }
    public function makeLike(Request $request)
    {
//        dd($request->all());
        User::find($request->user_id)->bookFavorite()->toggle($request->book_id);
        $books = User::find($request->user_id)->bookFavorite()->get();
//
        return response()->json(['books' => $books]);
    }

}
