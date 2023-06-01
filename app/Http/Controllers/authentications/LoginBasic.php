<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function submitLogin(Request $request)
  {

    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    $user = ['EmailAddress' => $request->email, 'password' => $request->password];

    if (Auth::attempt($user)) {
      $userLogin = Auth::getProvider()->retrieveByCredentials($user);
      Auth::login($userLogin);
      $request->session()->regenerate();
      return redirect()->intended();
    } else {
      return back()->withErrors([
        'password' => 'Wrong username or password',
      ]);
    }

  }

  public function logout()
  {
    Session::flush();

    Auth::logout();

    return redirect('/auth/login');
  }

}