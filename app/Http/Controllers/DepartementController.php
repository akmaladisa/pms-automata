<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Validator;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.departement.index', [
            'departementID' => IdGenerator::generate([
                'table' => 'mst_departement',
                'length' => 7,
                'field' => 'departement_id',
                'prefix' => 'DEP' 
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
        return response()->json( [ 'departements' => Departement::where('status', 'ACT')->orderBy('departement_name')->get() ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departement = $request->validate([
            'departement_id' => 'required',
            'departement_name' => 'required',
            'status' => 'required|max:3',
            'created_user' => 'required'
        ]);

        Departement::create($departement);

        alert()->success('Success','Departement Added Successfully');

        return redirect('/departement');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( Departement::find($id) ) {
            return response()->json([
                'status' => 200,
                'departement' => Departement::find($id)
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Departement not found"
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
        return view('dashboard.departement.edit', [
            'departement' => Departement::find($id)
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
        $departement = Validator::make($request->all(), [
            'departement_id' => "required",
            'departement_name' => 'required',
            'status' => 'required|max:3',
            'updated_user' => 'required'
        ]);

        if( $departement->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $departement->getMessageBag()
            ]);
        }

        $dprtmnt = Departement::find($id);

        if( $dprtmnt ) {
            $dprtmnt->update( $request->all() );
            return response()->json([
                'status' => 200,
                'message' => "Departement has been updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Departement not found"
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
        $departement = Departement::find($id);

        if( $departement ) {
            $departement->status = "DE";
            $departement->save();
            return response()->json([
                'status' => 200,
                'message' => "Departement has been deleted"
            ]);
        }
    }
}
