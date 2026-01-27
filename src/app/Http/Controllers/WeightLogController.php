<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeightLogRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightLogController extends Controller
{
    public function index()
    {
        $logs = WeightLog::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->get();

        $target = WeightTarget::where('user_id', auth()->id())->first();

        return view('weight_logs.index', compact('logs', 'target'));
    }

    public function store(StoreWeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);


        return redirect()->route('weight_logs.index');
    }

    public function create()
    {
        return view('weight_logs.create');
    }

    public function edit(WeightLog $weightLog)
    {
        // 自分のデータ以外を編集できないようにする
        if ($weightLog->user_id !== auth()->id()) {
            abort(403);
        }

        return view('weight_logs.edit', ['log' => $weightLog]);
    }

    public function update(StoreWeightLogRequest $request, WeightLog $weightLog)
    {
        if ($weightLog->user_id !== auth()->id()) {
            abort(403);
        }

        $weightLog->update($request->validated());

        return redirect()->route('weight_logs.index');
    }

    public function destroy(WeightLog $weightLog)
    {
        if ($weightLog->user_id !== auth()->id()) {
            abort(403);
        }

        $weightLog->delete();

        return redirect()->route('weight_logs.index');
    }
}
