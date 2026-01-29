<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeightLogRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightLogController extends Controller
{
    public function index()
    {
        $query = WeightLog::where('user_id', auth()->id());

        // 検索（from/to）
        if (request('from')) {
            $query->whereDate('date', '>=', request('from'));
        }
        if (request('to')) {
            $query->whereDate('date', '<=', request('to'));
        }

        $logs = $query->orderBy('date', 'desc')->paginate(8);

        $target = WeightTarget::where('user_id', auth()->id())->first();

        // 目標までの差分
        $latestWeight = $logs->first() ? $logs->first()->weight : null;
        $targetWeight = $target ? $target->target_weight : null;

        $diffToTarget = null;
        if (!is_null($latestWeight) && !is_null($targetWeight)) {
            $diffToTarget = round($latestWeight - $targetWeight, 1);
        }

        $count = $logs->total();
        return view('weight_logs.index', compact('logs', 'target', 'diffToTarget', 'count'));
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
        $query = WeightLog::where('user_id', auth()->id());

        // 検索（from/to）も同じにするならここも同様に
        if (request('from')) {
            $query->whereDate('date', '>=', request('from'));
        }
        if (request('to')) {
            $query->whereDate('date', '<=', request('to'));
        }

        $logs = $query->orderBy('date', 'desc')->paginate(8);

        $target = WeightTarget::where('user_id', auth()->id())->first();

        $latestWeight = $logs->first() ? $logs->first()->weight : null;
        $targetWeight = $target ? $target->target_weight : null;

        $diffToTarget = null;
        if (!is_null($latestWeight) && !is_null($targetWeight)) {
            $diffToTarget = round($latestWeight - $targetWeight, 1);
        }

        $count = $logs->total();

        return view('weight_logs.index', compact('logs', 'target', 'diffToTarget', 'count') + [
            'openCreateModal' => true,
        ]);
    }

    public function edit(WeightLog $weightLog)
    {
        // 自分のデータ以外を編集できないようにする
        if ($weightLog->user_id !== auth()->id()) {
            abort(403);
        }

        return view('weight_logs.edit', compact('weightLog'));
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
