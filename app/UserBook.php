<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBook extends Model
{
    //
    protected $table = 'user_books';
    protected $fillable = [
        'user_id',
        'book_id',
        'days',
        'price',
    ];

    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function books(){
        return $this->belongsTo(Book::class,"book_id");
    }
}
