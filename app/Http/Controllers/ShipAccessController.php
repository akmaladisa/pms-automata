<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\Ship;
use App\Models\ShipAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShipAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.ship-access.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read()
    {
        return response()->json([
            'ship_accesses' => ShipAccess::orderBy('created_at')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shipAccess = Validator::make($request->all(), [
            'id_ship' => 'required',
            'id_crew' => 'required'
        ]);

        if( $shipAccess->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $shipAccess->getMessageBag()
            ]);
        }

        ShipAccess::create( $request->all() );
        return response()->json([
            'status' => 200,
            'message' => "Ship Access created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ship_access = ShipAccess::find($id);
        $crew = $ship_access->crew->full_name ? $ship_access->crew->full_name : null;
        $ship = $ship_access->ship->ship_nm ? $ship_access->ship->ship_nm : null;

        if( $ship_access ) {
            return response()->json([
                'ship_access' => $ship_access,
                'crew' => $crew,
                'ship' => $ship, 
                'status' => 200
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.ship-access.edit', [
            'shipAccess' => ShipAccess::find($id),
            'crews' => Crew::all(),
            'ships' => Ship::all()
        ]);
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
        $shipAccess = Validator::make($request->all(), [
            'id_ship' => 'required',
            'id_crew' => 'required'
        ]);

        if( $shipAccess->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $shipAccess->getMessageBag()
            ]);
        }

        $old_data = ShipAccess::find($id);

        if( $old_data ) {
            $old_data->update( $request->all() );
            return response()->json([
                'status' => 200,
                'message' => "Ship access has been updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipAccess = ShipAccess::find($id);

        if( $shipAccess ) {
            $shipAccess->delete();
            return response()->json([
                'message' => "Ship access deleted successfully",
                'status' => 200
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }
}
