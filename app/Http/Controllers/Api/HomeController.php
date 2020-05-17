<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Category;
use App\Http\Controllers\Controller;
use App\User;
use App\UserFavourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->order == 'rate'){
            if($request->category == "0"){
                $books = Book::where([['bookName','like','%'.$request->search.'%']])
                    ->orWhere([['author','like','%'.$request->search.'%']])
                    ->orderBy("rate")
                    ->paginate(3);;
            }else{
                $books = Book::where([['bookName','like','%'.$request->search.'%'],["category_id",$request->category]])
                    ->orWhere([['author','like','%'.$request->search.'%'],["category_id",$request->category]])
                    ->orderBy("rate")
                    ->paginate(3);;
            }

        }else{
            if($request->category == "0"){
                $books = Book::where([['bookName','like','%'.$request->search.'%']])
                    ->orWhere([['author','like','%'.$request->search.'%']])
                    ->orderBy("created_at")
                    ->paginate(3);;
            }else{
                $books = Book::where([['bookName','like','%'.$request->search.'%'],["category_id",$request->category]])
                    ->orWhere([['author','like','%'.$request->search.'%'],["category_id",$request->category]])
                    ->orderBy("created_at")
                    ->paginate(3);;
            }
        }
        $userFavourites = User::find($request->user_id)->bookFavorite()->pluck("book_id")->all();
        $categories = Category::orderBy('name')->get();

        return response()->json(['books' => $books,'userFavourites' => $userFavourites,'categories' => $categories]);
    }
    public function makeLike(Request $request)
    {
//        dd($request->all());
        User::find($request->user_id)->bookFavorite()->toggle($request->book_id);
//        $books = Book::paginate(3);
//        $userFavourites = User::find($request->user_id)->bookFavorite()->pluck("book_id")->all();
//        $categories = Category::orderBy('name')->get();
//
//        return response()->json(['books' => $books,'userFavourites' => $userFavourites,'categories' => $categories]);
        return response()->json(true);
    }
    public function search(Request $request)
    {
        if($request->order == 'rate'){
            if($request->category == "0"){
                $books = Book::where([['bookName','like','%'.$request->search.'%']])
                                ->orWhere([['author','like','%'.$request->search.'%']])
                                ->orderBy("rate")
                                ->paginate(3);;
            }else{
                $books = Book::where([['bookName','like','%'.$request->search.'%'],["category_id",$request->category]])
                                ->orWhere([['author','like','%'.$request->search.'%'],["category_id",$request->category]])
                                ->orderBy("rate")
                                ->paginate(3);;
            }

        }else{
            if($request->category == "0"){
                $books = Book::where([['bookName','like','%'.$request->search.'%']])
                                ->orWhere([['author','like','%'.$request->search.'%']])
                                ->orderBy("created_at")
                                ->paginate(3);;
            }else{
                $books = Book::where([['bookName','like','%'.$request->search.'%'],["category_id",$request->category]])
                                ->orWhere([['author','like','%'.$request->search.'%'],["category_id",$request->category]])
                                ->orderBy("created_at")
                                ->paginate(3);;
            }
        }
        $userFavourites = User::find($request->user_id)->bookFavorite()->pluck("book_id")->all();
        $categories = Category::orderBy('name')->get();
        return response()->json(['books' => $books,'userFavourites' => $userFavourites,'categories' => $categories]);
    }
}
