<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CounterController extends Controller
{
    public function index()
    {
        return view('dashboard.counter.index');
    }

    public function read()
    {
        return response()->json( [ 'counters' => Counter::where('status', 'ACT')->get() ] );
    }

    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'ship_name' => "required",
            'date' => 'required',
            'item_description' => "required",
            'part_no' => 'required',
            'starting_of_running_hours' => 'required',
            'unit_runing' => 'required',
            'remarks' => 'required',
            'status' => 'required|max:3'
        ] );

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        Counter::create( $request->all() );

        return response()->json([
            'status' => 200,
            'message' => "Counter has been added"
        ]);
    }

    public function show($id)
    {
        if( Counter::find($id) ) {
            return response()->json([
                'status' => 200,
                'counter' => Counter::find($id)
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make( $request->all(), [
            'ship_name' => "required",
            'date' => 'required',
            'item_description' => "required",
            'part_no' => 'required',
            'starting_of_running_hours' => 'required',
            'unit_runing' => 'required',
            'remarks' => 'required',
            'status' => 'required|max:3'
        ] );

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        $counter = Counter::find($id);

        if( $counter ) {
            $counter->update( $request->all() );
            return response()->json([
                'status' => 200,
                'message' => "Counter has been updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);

    }

    public function destroy($id)
    {
        $counter = Counter::find($id);
        if( $counter ) {
            $counter->status = "DE";
            $counter->save();
            return response()->json([
                'status' => 200,
                'message' => "Counter has been deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }
}
