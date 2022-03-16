<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;

class PageController extends Controller
{
    // Public Pages

    public function index() {
        $users = User::index();
        $members = Member::all();
        return view('users', ['members' => $members]);
    }
    public function register() {
        return view('register');
    }
    public function login() {
        return view('login');
    }

    // Admin Pages

    public function create() {
        return view('create');
    }

    public function edit($id) {
        return view('edit', ['id' => $id]);
    }

    public function media($id) {
        return view('media', ['id' => $id]);
    }

    public function profile($id) {
        return view('profile', ['id' => $id]);
    }

    public function security($id) {
        return view('security', ['id' => $id]);
    }

    public function status($id) {
        return view('status', ['id' => $id]);
    }
}
