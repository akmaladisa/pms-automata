<?php

namespace App\Http\Controllers;

use App\Models\ListCounter;
use App\Models\ReportCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ListCounterController extends Controller
{
    public function read()
    {
        return response()->json([
            'list_counters' => ListCounter::where('status', 'ACT')->orderBy("ship_name")->orderBy('last_running_hours')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ship_name' => 'required',
            'item_description' => 'required',
            'part_no' => 'required',
            'start_date' => 'required|before:end_date',
            'end_date' => 'required',
            'last_running_hours' => 'required|numeric',
            'unit_running' => "required",
            'running_hours_today' => 'required|numeric',
            'update_running_hours' => 'required|numeric',
            'status' => 'required|max:3'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        ListCounter::create( $request->all() );

        $report_counter = new ReportCounter();
        $report_counter->ship_name = $request->ship_name;
        $report_counter->item_description = $request->item_description;
        $report_counter->part_no = $request->part_no;
        $report_counter->start_date = $request->start_date;
        $report_counter->end_date = $request->end_date;
        $report_counter->last_running_hours = $request->last_running_hours;
        $report_counter->update_running_hours = $request->running_hours_today;
        $report_counter->total_running_hours = $request->last_running_hours + $request->running_hours_today;
        $report_counter->save();

        return response()->json([
            'status' => 200,
            'message' => "List Counter Added"
        ]);
    }

    public function show($id)
    {
        if( ListCounter::find($id) ) {
            return response()->json([
                'status' => 200,
                'list_counter' => ListCounter::find($id)
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ship_name' => 'required',
            'item_description' => 'required',
            'part_no' => 'required',
            'start_date' => 'required|before:end_date',
            'end_date' => 'required',
            'last_running_hours' => 'required|numeric',
            'unit_running' => "required",
            'running_hours_today' => 'required|numeric',
            'update_running_hours' => 'required|numeric',
            'status' => 'required|max:3'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        $list_counter = ListCounter::find($id);

        // previous report
        $previous_report = DB::table('report_counters')->where([
            ['ship_name', '=', $list_counter->ship_name],
            ["item_description", '=',$list_counter->item_description],
            ['part_no', '=', $list_counter->part_no]
        ])->latest()
            ->first();


        if( $list_counter ) {
            $list_counter->update( $request->all() );

            // getting history report
            $new_history_report_counter = new ReportCounter();
            $new_history_report_counter->ship_name = $request->ship_name;
            $new_history_report_counter->item_description = $request->item_description;
            $new_history_report_counter->part_no = $request->part_no;
            $new_history_report_counter->start_date = $request->start_date;
            $new_history_report_counter->end_date = $request->end_date;
            $new_history_report_counter->last_running_hours = $previous_report->total_running_hours;
            $new_history_report_counter->update_running_hours = $request->running_hours_today;
            $new_history_report_counter->total_running_hours = $previous_report->total_running_hours  + $request->running_hours_today;
            $new_history_report_counter->save();


            return response()->json([
                'status' => 200,
                'message' => "List Counter updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);

    }

    public function destroy($id)
    {
        $list_counter = ListCounter::find($id);
        if( $list_counter ) {
            $list_counter->status = "DE";
            $list_counter->save();
            return response()->json([
                'status' => 200,
                'message' => "List counter deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }
}
