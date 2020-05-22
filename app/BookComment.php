<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookComment extends Model
{
    //

    protected $table = 'book_comments';
    protected $fillable = [
        'user_id',
        'book_id',
        'comment',
    ];
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
