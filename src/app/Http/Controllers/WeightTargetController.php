<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightTarget;
use App\Http\Requests\UpdateWeightTargetRequest;

class WeightTargetController extends Controller
{
    public function edit()
    {
        $target = WeightTarget::where('user_id', auth()->id())->first();


        return view('weight_targets.edit', compact('target'));
    }


    public function update(UpdateWeightTargetRequest $request)
    {
        $validated = $request->validated();


        WeightTarget::updateOrCreate(
            ['user_id' => auth()->id()],
            ['target_weight' => $validated['target_weight']]
        );


        return redirect()->route('weight_logs.index');
    }
}
