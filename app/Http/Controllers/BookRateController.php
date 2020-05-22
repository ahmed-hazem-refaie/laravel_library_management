<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookRate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rate = BookRate::where([['user_id', Auth::id()], ['book_id', $request->book_id]]);
        //    dd($rate->count());
        if ($rate->count() == 0) {
            User::find(Auth::id())->myRate()->create($request->all());
        } else {
            User::find(Auth::id())->myRate()->where('book_id', $request->book_id)->update(['rate' => $request->rate]);
        }
        $sumRate = BookRate::where('book_id', $request->book_id)->avg('rate');
        Book::find($request->book_id)->update(['rate' => $sumRate]);        
        return response()->json(['rate' => $request->rate]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookRate  $bookRate
     * @return \Illuminate\Http\Response
     */
    public function show(BookRate $bookRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookRate  $bookRate
     * @return \Illuminate\Http\Response
     */
    public function edit(BookRate $bookRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookRate  $bookRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookRate $bookRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookRate  $bookRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookRate $bookRate)
    {
        //
    }
}
