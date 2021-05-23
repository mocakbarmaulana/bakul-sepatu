<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMemberController extends Controller
{
    public function getLogin()
    {
        if(auth('member')->check()) {
            return redirect()->route('home');
        }

        return view('member.login');
    }

    public function setLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $auth = $request->only('email', 'password');
        $auth['status'] = 1;

        if (Auth::guard('member')->attempt($auth)) {
            return redirect()->intended(route('home'));
        }

        return redirect()->back()->with('error', 'Email / password tidak cocok');
    }

    public function getRegister()
    {

        if(auth('member')->check()) {
            return redirect()->route('home');
        }

        return view('member.register');
    }

    public function setRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:members',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $member = new Member();
        $member->name = $request->name;
        $member->email = $request->email;
        $member->password = $request->password;
        $member->status = 1;
        $member->save();

        return redirect()->route('member.login');
    }

    public function logout(){
        Auth::guard('member')->logout();

        return redirect(route('home'));
    }
}
