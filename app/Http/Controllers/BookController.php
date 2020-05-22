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
use Illuminate\Support\Str;

use  Uuid;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Uuid::generate()->string,Uuid::generate()->string );
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
        $users = User::with('roles')->get();

        // dd($categories->pluck('name','id')->toArray());
        return view('manager.bookform', ['categories' => $categories, 'users' => $users]);
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
        if ($files = $request->file('image')) {
            //  $path= $request->file('image')->store('images');
            $desti = 'myimages/';
            $book = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($desti, $book);
            //  dd($path);
            //  ->store(public_path('images'));
            //  ->store('/images');
            // $imageName = time().'.'.request()->image->getClientOriginalExtension();



            // request()->image->move(public_path('images'), $imageName);
            //  $request->file('image')->
            $data->image = $book;
            $data->save();
        }
        return Redirect(route('manager.book.index'))->with('status', 'done');
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
        $userRate = $book->rates()->with('userRate')->where('user_id', Auth::id())->select('rate')->get();
        $relativeBook = Book::where([['category_id', $book['category_id']], ['id', '!=', $book['id']]])->limit(5)->get();
        $like = User::find(Auth::id())->bookFavorite()->where('book_id', $book->id)->get();
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
        $this->authorize('update-book');
        //
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
        return Redirect(route('manager.book.index'))->with('status', 'done');
    }
}
