<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Validator;

class ShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.ship.index', [
            'shipID' => IdGenerator::generate([
                'table' => 'mst_ship',
                'length' => 7,
                'field' => 'id_ship',
                'prefix' => 'SHP' 
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read()
    {
        return response()->json([
            'ships' => Ship::where('status', 'ACT')->orderBy('ship_nm')->get()
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
        $newShip = $request->validate([
            'id_ship' => 'required',
            'ship_nm' => 'required',
            'description' => 'required',
            'status' => 'required|max:3',
            'created_user' => 'required'
        ]);

        Ship::create( $newShip );
        alert()->success("Success", "Ship created successfully");

        return redirect('/ship');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ship = Ship::find($id);
        if( $ship ) {
            return response()->json([
                'status' => 200,
                'ship' => $ship
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Ship  not found"
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
        return view('dashboard.ship.edit', [
            'ship' => Ship::find($id)
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
        $newShip = Validator::make($request->all(), [
            'ship_nm' => 'required',
            'description' => 'required',
            'status' => 'required|max:3',
            'updated_user' => 'required'
        ]);

        if( $newShip->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $newShip->getMessageBag()
            ]);
        }

        $old_ship = Ship::find($id);

        if( $old_ship ) {
            $old_ship->update( $request->all() );
            return response()->json([
                'status' => 200,
                'message' => "Ship has been updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Ship  not found"
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
        $ship = Ship::find( $id );

        if($ship) {
            $ship->status = "DE";
            $ship->save();
            return response()->json([
                'status' => 200,
                'message' => "Ship status changed to 'DE'"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Ship  not found"
        ]);
    }
}
