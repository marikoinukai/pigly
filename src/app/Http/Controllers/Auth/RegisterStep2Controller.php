<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterStep2Controller extends Controller
{
    public function create(Request $request)
    {
        // STEP1を通ってない直アクセスを防ぐ
        if (!$request->session()->has('register.step1')) {
            return redirect()->route('register.step1');
        }

        return view('auth.register-step2');
    }
}
