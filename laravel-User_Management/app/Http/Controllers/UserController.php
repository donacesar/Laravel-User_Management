<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private function access($id) {
        dd('Метод ACCESS запущен');
        if(Auth::user()->id != $id && !Auth::user()->is_admin) {
            Session::flash('danger', 'У вас не достаточно прав');
            return redirect()->route('home')->throwResponse();
        }
    }

    private function adminAccess() {
        if (true) {}
    }
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
        Session::flash('danger', 'Неверный логин или пароль.');
        return redirect()->route('login');

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');

    }

    public function register(Request $request) {

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $member = new Member();
        $member->user_id = $user->id;
        $member->save();
        Session::flash('success', 'Регистрация прошла успешно.');
        return redirect()->route('login');
    }

    public function create(Request $request) {

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $member = new Member();
        $member->user_id = $user->id;
        $member->save();
        Session::flash('success', 'Создание пользователя пешно завершено.');
        return redirect()->route('home');


        dd($request->all());

    }


    public function edit(Request $request, $id) {
        $this->access($id);
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

