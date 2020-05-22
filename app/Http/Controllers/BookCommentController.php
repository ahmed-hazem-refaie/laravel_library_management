<?php

namespace App\Http\Controllers;

use App\BookComment;
use Illuminate\Http\Request;

class BookCommentController extends Controller
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
        // dd($request->all());
        BookComment::create($request->all());
        return redirect()->back()->with('success','Comment Has been added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookComment  $bookComment
     * @return \Illuminate\Http\Response
     */
    public function show(BookComment $bookComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookComment  $bookComment
     * @return \Illuminate\Http\Response
     */
    public function edit(BookComment $bookComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookComment  $bookComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookComment $bookComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookComment  $bookComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookComment $bookComment)
    {
        //
    }
}
