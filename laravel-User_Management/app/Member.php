<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model{

    protected $fillable = [
        'name', 'workplace', 'phone', 'user_id', 'address', 'status', 'avatar'
    ];

    // Либо можно использовать обратное свойство, запрещающее заполнение
    // public $guarded = []; - т.е. ничего не запрещено

    public $timestamps = false;

	 /*public static function all() {
        $members = DB::table('members')->select('*')->get();
        $allMembers = $members->all();
        return $allMembers;
    }*/

    public static function one($id) {
	     return DB::table('members')->select('*')->where('user_id', $id)->get()->first();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }


}
