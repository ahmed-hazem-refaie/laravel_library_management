<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    protected $table = "Books";
    protected $fillable = [
        'bookName',
        'pricePerDay',
        'author',
        'description',
        'image',
        'count',
        'rate',
        'category_id',
        'user_id',
    ];
    public function users(){
        return $this->belongsToMany(User::class,"user_books","book_id","user_id");
    }
}
