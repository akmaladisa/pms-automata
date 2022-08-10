<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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
            'ships' => DB::table('mst_ship')->where('status', 'ACT')->orderBy('id_ship')->get(),
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
    public function create()
    {
        
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

        Ship::create($newShip);

        alert()->success('Success','Ship Added Successfully');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.ship.show', [
            'ship' => Ship::find($id)
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
    public function update(Request $request, $id_ship)
    {
        $newShip = $request->validate([
            'ship_nm' => 'required',
            'description' => 'required',
            'status' => 'required|max:3',
            'updated_user' => 'required'
        ]);

        if( Ship::find($id_ship)->update($newShip) ) {
            alert()->success('Success','Ship Updated Successfully');

            return redirect('/ship');
        }

        alert()->error('Error','Failed To Update Ship');

        return redirect('/ship');
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

        $ship->status = "DE";

        $ship->save();

        alert()->success('Success',"Ship Status Changed To 'DE' ");

        return redirect('/ship');
    }
}
