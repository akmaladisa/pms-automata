<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\Ship;
use App\Models\ShipAccess;
use Illuminate\Http\Request;

class ShipAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.ship-access.index', [
            'shipAccess' => ShipAccess::all(),
            'crews' => Crew::all(),
            'ships' => Ship::all()
        ]);
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
        $shipAccess = $request->validate([
            'id_ship' => 'required',
            'id_crew' => 'required'
        ]);

        ShipAccess::create( $shipAccess );

        alert()->success("Success", "Ship Access Created Successfully");

        return redirect()->route('ship-access.index');
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
        $shipAccess = $request->validate([
            'id_ship' => 'required',
            'id_crew' => 'required'
        ]);

        ShipAccess::find( $id )->update( $shipAccess );

        alert()->success("Success", "Ship Access Updated Successfully");

        return redirect()->route('ship-access.index');
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

        $shipAccess->delete();

        alert()->success("Success", "Ship Access Deleted Successfully");

        return redirect()->route('ship-access.index');
    }
}
