<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterStep2Request;

use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function store(RegisterStep2Request $request)
    {
        if (!$request->session()->has('register.step1')) {
            return redirect()->route('register.step1');
        }

        $validated = $request->validated();

        $step1 = $request->session()->get('register.step1');

        $user = DB::transaction(function () use ($step1, $validated) {
            $user = User::create([
                'name'     => $step1['name'],
                'email'    => $step1['email'],
                'password' => $step1['password'],
            ]);

            WeightTarget::create([
                'user_id' => $user->id,
                'target_weight' => $validated['target_weight'],
            ]);

            WeightLog::create([
                'user_id' => $user->id,
                'date' => now()->toDateString(),
                'weight' => $validated['current_weight'],
                'calories' => 0,
                'exercise_time' => 0,
            ]);

            return $user;
        });

        Auth::login($user);
        $request->session()->forget('register.step1');

        return redirect()->route('weight_logs.index');
    }
}
