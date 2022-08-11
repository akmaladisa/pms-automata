<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Crew;
use App\Models\JenisIdentitas;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CrewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.crew.index', [
            'crew' => Crew::where('status', 'ACT')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.crew.create', [
            'crewId' => IdGenerator::generate([
                'table' => 'mst_crew',
                'length' => 8,
                'field' => 'id_crew',
                'prefix' => 'CR' 
            ]),
            'countries' => Country::all(),
            'identytiesType' => JenisIdentitas::all()
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
        $crew = $request->validate([
            'id_crew' => "required",
            'full_name' => 'required',
            'email' => 'required|email',
            'identity_type' => 'required',
            'identity_number' => 'required',
            'job_title' => 'required',
            'country' => 'required',
            'phone' => "required",
            'whatsapp_phone' => 'required',
            'gender' => 'required',
            'status_merital' => 'required',
            'pob' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'join_date' => 'required',
            'note' => 'required',
            'status' => 'required|max:3',
            'join_port' => 'required',
            'photo' => 'image|file',
            'created_user' => 'required'
        ]);

        if( $request->file('photo') ) {
            $crew['photo'] = $request->file('photo')->store('crew-img');
        }

        Crew::create($crew);

        alert()->success("Success", "Crew Added Successfully");

        return redirect()->route('crew.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
