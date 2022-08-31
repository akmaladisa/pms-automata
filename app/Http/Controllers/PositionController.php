<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.position.index');
    }

    public function read()
    {
        return response()->json(['positions' => Position::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        if( Position::create($request->all()) ) {
            return response()->json([
                'status' => 200,
                'message' => 'Position Has Been Added'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Failed To Add Position'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = Position::find($id);

        if( $position ) {
            return response()->json([
                'status' => 200,
                'position' => $position
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Position Not Found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $position = Position::find($id);

        if( $position ) {
            $position->update( $request->all() );

            return response()->json([
                'status' => 200,
                'message' => 'Position Has Been Updated'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Position Not Found'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Position::find($id) ) {
            Position::find($id)->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Position Has Been Deleted'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Position Not Found"
            ]);
        }
    }
}
