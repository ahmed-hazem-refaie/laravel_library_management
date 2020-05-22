<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookComment;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('manager.books', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $w=Category::find();
        $categories = Category::all()->pluck('name', 'id')->toArray();

        // dd($categories->pluck('name','id')->toArray());
        return view('manager.bookform', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = 1;

        // dd($data);
        $data = Book::create($data);
        if ($request->file('image')) {
            $path = $request->file('image')->store('public/images');
            $data->image = $path;
            $data->save();
        }
        return Redirect(route('book.index'))->with('status', 'done');
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $comments = $book->comments()->with('user')->get();
        $userRate = $book->rates()->with('userRate')->where('user_id',Auth::id())->select('rate')->get();
        $relativeBook = Book::where([['category_id', $book['category_id']],['id','!=',$book['id']]])->limit(5)->get(); 
        $like=User::find(Auth::id())->bookFavorite()->where('book_id',$book->id)->get();     
        $data = [
            'comments' => $comments,
            'rate' => $userRate,
            'book' => $book,
            'related' => $relativeBook,
            'like' => $like
        ];
        // dd($userRate[0]->rate);
        return view('books.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        // dd($book);
        $categories = Category::all()->pluck('name', 'id')->toArray();
        // dd($categories->pluck('name','id')->toArray());

        return view('manager.bookEditform', ['categories' => $categories, 'mybook' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // dd($request);
        $book->update($request->all());

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        // return route('book.index');
        return Redirect(route('book.index'))->with('status', 'done');
    }
}
