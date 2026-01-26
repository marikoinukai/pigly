<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;

class WeightLogController extends Controller
{
    public function index()
    {
        $logs = WeightLog::orderBy('date', 'desc')->get();
        return view('weight_logs.index', compact('logs'));

        return view('weight_logs.index', compact('logs'));
    }
}
