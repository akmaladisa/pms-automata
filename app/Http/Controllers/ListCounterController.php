<?php

namespace App\Http\Controllers;

use App\Models\ListCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListCounterController extends Controller
{
    public function read()
    {
        return response()->json([
            'list_counters' => ListCounter::where('status', 'ACT')->get()
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
            'last_running_hours' => 'required',
            'running_hours_today' => 'required',
            'update_running_hours' => 'required',
            'status' => 'required|max:3'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }
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
            'last_running_hours' => 'required',
            'running_hours_today' => 'required',
            'update_running_hours' => 'required',
            'status' => 'required|max:3'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        $list_counter = ListCounter::find($id);

        if( $list_counter ) {
            $list_counter->update( $request->all() );

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
