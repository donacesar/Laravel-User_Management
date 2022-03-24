<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function index() {
       /* $users = DB::table('users')->select('*')->get();
        $allUsers = $users->all();
        return $allUsers;*/

        return self::all();
    }

    public static function one($id) {
        $user = DB::table('users')->select('*')->where('id', $id)->get();
    }

    public function member() {
        return $this->hasOne('App\Member');
    }
}
