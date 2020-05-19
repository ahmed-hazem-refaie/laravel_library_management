<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFavourite extends Model
{
    //
    protected $table = 'user_favourites';
    protected $fillable = [
        'user_id',
        'book_id',
    ];
    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function books(){
        return $this->belongsTo(Book::class,"book_id");
    }
}
