<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use function Laravel\Prompts\error;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if  (Auth::check()) {
            return redirect('home');
        }else{
            return view('login');
        }
    }
    public function actionlogin(Request $request)

    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        
        if (empty($data['email']) || empty($data['password'])) {
            Session::flash('error', 'email atau password tidak boleh kosong');
            return redirect('/');
        }
        
        if (Auth::attempt($data)) {
            return redirect('home');
        } else {
            Session::flash('error', 'email atau password salah');
            return redirect('/');
        }
        
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
