<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $fillable = [
        'role_id',
        'user_id'
    ];
    public function users(){
        return $this->belongsToMany('App\User', 'user_id' );
        
    }
    public function roles(){
        return $this->belongsToMany('App\Role', 'role_id' );
        
    }
}
