<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookRate extends Model
{

    //
    protected $table = 'book_rates';
    protected $fillable = [
        'user_id',
        'book_id',
        'rate',
    ];
    public function userRate()
    {
        return $this->belongsTo(User::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

}
