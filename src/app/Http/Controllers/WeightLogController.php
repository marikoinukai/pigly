<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeightLogRequest;
use App\Models\WeightLog;

class WeightLogController extends Controller
{
    public function index()
    {
        $logs = WeightLog::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->get();

        return view('weight_logs.index', compact('logs'));
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
}
