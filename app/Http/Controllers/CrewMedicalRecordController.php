<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Crew;
use Illuminate\Http\Request;
use App\Models\CrewMedicalRecord;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\ValidatedData;

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
            'crews' => Crew::where('status', 'ACT')->get(),
            'records' => CrewMedicalRecord::where('status', 'ACT')->get()
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
        $validator = Validator::make($request->all(), [
            'id_crew' => 'required',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'mcu_issued' => 'required',
            'mcu_expired' => 'required',
            'history_of_pain' => 'required',
            'status' => 'required',
            'created_user' => 'required'
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            // CrewMedicalRecord::create( $request->all() );

            $crew_medical = new CrewMedicalRecord();
            $crew_medical->id_crew = $request->id_crew;
            $crew_medical->height = $request->height;
            $crew_medical->weight = $request->weight;
            $crew_medical->mcu_issued = $request->mcu_issued;
            $crew_medical->mcu_expired = $request->mcu_expired;
            $crew_medical->history_of_pain = $request->history_of_pain;
            $crew_medical->status = $request->status;
            $crew_medical->created_user = $request->created_user;
            $crew_medical->save();

            return response()->json([
                'status' => 200,
                'message' => 'Crew Medical Record Has Been Added'
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
            'status' => 'required|max:3',
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
