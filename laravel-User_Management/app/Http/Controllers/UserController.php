<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private function access($id) {
        if(Auth::user()->member->id != $id and Auth::user()->role !== 'admin') {
            Session::flash('danger', 'У вас не достаточно прав');
            return redirect()->route('home')->throwResponse();
        }
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
            Session::flash('success', 'Вы успешно авторизованы');
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

        if (Auth::user()->role !== 'admin') {
            Session::flash('danger', 'У вас нет прав администратора.');
            return redirect()->route('home')->throwResponse();
        }

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'avatar' => 'image',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $member = new Member();
        $member->status = $request->status;
        $member->avatar = $request->file('avatar')->store('img/avatars', 'public');
        $member->name = $request->name;
        $member->workplace = $request->workplace;
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->user_id = $user->id;
        $member->save();
        Session::flash('success', 'Создание пользователя успешно завершено.');
        return redirect()->route('home');
    }


    public function edit(Request $request, $id) {
        $this->access($id);

        $member = Member::find($id);
        $member->name = $request->name;
        $member->workplace = $request->workplace;
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->save();
        Session::flash('success', 'Редактирование прошло успешно.');
        return redirect()->route('home');
    }

    public function media(Request $request, $id) {
        $this->access($id);

        $this->validate($request, [
           'avatar' => 'required|image',
        ]);
        $member = Member::find($id);
        Storage::disk('public')->delete($member->avatar);
        $member->avatar = $request->file('avatar')->store('img/avatars', 'public');
        $member->save();
        Session::flash('success', 'Аватар успешно изменен.');
        return redirect()->route('home');

    }


    public function security(\Illuminate\Http\Request $request, $id) {

        $this->access($id);

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
        Session::flash('success', 'Email и(или) пароль были обновлены.');
        return redirect()->route('home');

    }

    public function status(\Illuminate\Http\Request $request, $id) {
        $this->access($id);
        $member = Member::find($id);
        $member->status = $request->status;
        $member->save();
        Session::flash('success', 'Статус установлен.');
        return redirect()->route('home');
    }

    public function delete($id) {
        $this->access($id);

        $member = Member::find($id);
        Storage::disk('public')->delete($member->avatar);

        $id = $member->user_id;

        $member->user->delete();
        $member->delete();

        if(Auth::user()->id == $id) {
            Auth::logout();
        }
        Session::flash('success', 'Пользователь успешно удален');
        return back();
    }
}

