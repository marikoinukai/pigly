<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightTarget;

class WeightTargetController extends Controller
{
    public function edit()
    {
        $target = WeightTarget::where('user_id', auth()->id())->first();


        return view('weight_targets.edit', compact('target'));
    }


    public function update(Request $request)
    {
        $validated = $request->validate([
            'target_weight' => ['required', 'numeric'],
        ]);


        WeightTarget::updateOrCreate(
            ['user_id' => auth()->id()],
            ['target_weight' => $validated['target_weight']]
        );


        return redirect()->route('weight_logs.index');
    }
}
