<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public static function access($id) {

        if ((Auth::user()->member->id != $id) and (Auth::user()->role !== 'admin')) {
            Session::flash('danger', 'У вас не достаточно прав');
            return redirect()->route('home')->throwResponse();
        }
    }

    // Public Pagesdie;

    public function register() {
        return view('register');
    }
    public function login() {
        return view('login');
    }

    // Public with auth pages

    public function index() {
        $members = Member::paginate(6);
        return view('users', ['members' => $members]);
    }

    public function profile($id) {
        $member = Member::find($id);
        return view('profile', ['member' => $member]);
    }

    // Admin Pages

    public function create() {
        if (Auth::user()->role !== 'admin') {
            Session::flash('danger', 'У вас нет прав администратора.');
            return redirect()->route('home')->throwResponse();
        }
        return view('create');
    }

    public function edit($id) {
        self::access($id);
        return view('edit', ['id' => $id]);
    }

    public function media($id) {
        self::access($id);
        return view('media', ['id' => $id]);
    }


    public function security($id) {
        self::access($id);
        return view('security', ['id' => $id]);
    }

    public function status($id) {
        self::access($id);
        return view('status', ['id' => $id]);
    }
}
