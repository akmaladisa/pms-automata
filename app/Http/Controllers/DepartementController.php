<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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
            'departements' => DB::table('mst_departement')->where('status', 'ACT')->orderBy('departement_id')->get(),
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
        return view('dashboard.departement.show', [
            'departement' => Departement::find($id)
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
        $departement = $request->validate([
            'departement_id' => "required",
            'departement_name' => 'required',
            'status' => 'required|max:3',
            'updated_user' => 'required'
        ]);

        if( Departement::find($id)->update($departement) ) {
            alert()->success('Success','Departement Updated Successfully');

            return redirect('/departement');
        }

        alert()->error('Error','Failed To Update Vendor');

        return redirect('/vendors');
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

        $departement->status = "DE";

        $departement->save();

        alert()->success('Success',"Departement Status Changed To 'DE'");

        return redirect('/departement');
    }
}
