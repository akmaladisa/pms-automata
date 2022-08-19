<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\CrewMedicalRecord;
use Illuminate\Http\Request;

class CrewMedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.crew-medical-record.index', [
            'crews' => Crew::where('status', 'ACT')->get()
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
        $crew = $request->validate([
            'id_crew' => 'required',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'mcu_issued' => 'required',
            'mcu_expired' => 'required',
            'history_of_pain' => 'required',
            'created_user' => 'required'
        ]);

        if( CrewMedicalRecord::create( $crew ) ) {
            alert()->alert("Success", "Medical Record Created");

            return redirect()->route('crew-medical-record.index');
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
        return view('dashboard.crew-medical-record.show', [
            'medicalRecord' => CrewMedicalRecord::find($id)
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
        return view('dashboard.crew-medical-record.edit', [
            'medicalRecord' => CrewMedicalRecord::find($id),
            'crews' => Crew::where('status', 'ACT')->get()
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
        $crew = $request->validate([
            'id_crew' => 'required',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'mcu_issued' => 'required',
            'mcu_expired' => 'required',
            'history_of_pain' => 'required',
            'updated_user' => 'required'
        ]);

        if( CrewMedicalRecord::find($id)->update( $crew ) ) {
            alert()->success("Success", "Medical Record Updated");

            return redirect()->route('crew-medical-record.index');
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicalRecord = CrewMedicalRecord::find($id);
        $medicalRecord->status = "DE";
        $medicalRecord->save();

        alert()->success("Success", "Medical Record Deleted");

        return redirect()->route('crew-medical-record.index');
    }
}
