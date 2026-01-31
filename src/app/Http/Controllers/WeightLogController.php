<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreWeightLogRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightLogController extends Controller
{
    private function buildIndexData(Request $request): array
    {
        $query = WeightLog::where('user_id', auth()->id());

        if ($request->filled('from')) $query->whereDate('date', '>=', $request->from);
        if ($request->filled('to'))   $query->whereDate('date', '<=', $request->to);

        $logs = $query->orderBy('date', 'desc')->paginate(8);
        $target = WeightTarget::where('user_id', auth()->id())->first();

        $latestWeight = optional($logs->first())->weight;
        $targetWeight = optional($target)->target_weight;

        $diffToTarget = (!is_null($latestWeight) && !is_null($targetWeight))
            ? round($latestWeight - $targetWeight, 1)
            : null;

        return [
            'logs' => $logs,
            'target' => $target,
            'diffToTarget' => $diffToTarget,
            'count' => $logs->total(),
        ];
    }
    public function index(Request $request)
    {
        $data = $this->buildIndexData($request);
        return view('weight_logs.index', $data);
    }

    public function create(Request $request)
    {
        $data = $this->buildIndexData($request);
        return view('weight_logs.index', $data)->with('openCreateModal', true);
    }

    public function store(StoreWeightLogRequest $request)
    {
        $exerciseTime = null;
        if ($request->filled('exercise_time')) {

            // 01:30 → 01:30:00
            $exerciseTime = $request->exercise_time . ':00';
        }

        WeightLog::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $exerciseTime,
            'exercise_content' => $request->exercise_content,
        ]);


        return redirect()->route('weight_logs.index');
    }

    public function show(WeightLog $weightLog)
    {
        if ($weightLog->user_id !== auth()->id()) abort(403);

        return view('weight_logs.edit', compact('weightLog'));
    }

    public function update(StoreWeightLogRequest $request, WeightLog $weightLog)
    {
        if ($weightLog->user_id !== auth()->id()) abort(403);

        $validated = $request->validated();

        // 12:34 → 12:34:00 に変換してDBへ
        $validated['exercise_time'] = $validated['exercise_time'] . ':00';

        $weightLog->update($validated);

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
