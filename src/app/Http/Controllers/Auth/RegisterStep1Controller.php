<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\RegisterStep1Request;


class RegisterStep1Controller extends Controller
{
    public function create()
    {
        return view('auth.register-step1');
    }

    public function store(RegisterStep1Request $request)
    {
        $validated = $request->validated();

        $request->session()->put('register.step1', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('register.step2');
    }
}
