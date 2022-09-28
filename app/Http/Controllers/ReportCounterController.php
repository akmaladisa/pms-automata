<?php

namespace App\Http\Controllers;

use App\Models\ReportCounter;
use Illuminate\Http\Request;

class ReportCounterController extends Controller
{
    public function read()
    {
        return response()->json([
            'report_counters' => ReportCounter::orderBy('ship_name')->orderBy('last_running_hours')->get()
        ]);
    }

    public function show($ship)
    {
        return response()->json([
            'report_counter' => ReportCounter::where("ship_name", $ship)->orderBy('last_running_hours')->get()
        ]);
    }
}
