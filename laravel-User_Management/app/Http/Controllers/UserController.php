<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(Request $request) {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if($request->remember == "on"){
            $is_remembered = true;
        } else {
            $is_remembered = false;
        }

        if(Auth::attempt($credentials, $is_remembered)) {
            /*$request->session()->regenerate();
            $request->session(['status' => 'User logged in successfully!']);*/
            return redirect()->route('home');

        }

        // Логин не сработал
        dd($request->all());

    }

    public function logout()
    {
        Auth::logout();

      /*  $request->session()->invalidate();

        $request->session()->regenerateToken();*/

        return redirect()->route('login');

    }

    public function create(Request $request) {

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);



        dd($request->all());

    }

    public function register(Request $request) {

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        dd($request->all());
    }

    public function edit(Request $request, $id) {

        dd($id, $request->all());

    }

    public function media(Request $request, $id) {

        $this->validate($request, [

           'image' => 'required|image',

        ]);
        dd($id, $request->all());

    }

    public function profile(Request $request, $id) {

        dd($id, $request->all());

    }

    public function security(\Illuminate\Http\Request $request, $id) {

        $user_id = DB::table('members')->where('id', $id)->first()->user_id;
        $old_email = DB::table('users')->where('id', $user_id)->first()->email;


        if($old_email != $request->email){//сравниваем email из формы и email в базе
            //валидация данных формы если email был измененн
            $request->validate([
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ]);
        }else{
            //валидация данных формы если email не был измененн
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ]);
        }
        dd($id, $request->all());

    }

    public function status(\Illuminate\Http\Request $request, $id) {

        dd($id, $request->all());

    }
}

