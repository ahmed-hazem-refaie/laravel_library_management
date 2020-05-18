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

}
