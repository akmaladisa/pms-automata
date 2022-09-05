<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Crew;
use Illuminate\Http\Request;
use App\Models\CrewMedicalRecord;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Database\Eloquent\Builder;

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
            'blood_type' => 'required',
            'mcu_validity_date' => 'required',
            'mcu_expired' => 'required',
            'warning_period' => 'required',
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
            $crew_medical->mcu_validity_date = $request->mcu_validity_date;
            $crew_medical->mcu_expired = $request->mcu_expired;
            $crew_medical->history_of_pain = $request->history_of_pain;
            $crew_medical->status = $request->status;
            $crew_medical->created_user = $request->created_user;
            $crew_medical->warning_period = $request->warning_period;
            $crew_medical->blood_type = $request->blood_type;
            $crew_medical->save();

            return response()->json([
                'status' => 200,
                'message' => 'Crew Medical Record Has Been Added'
            ]);
        }
    }

    public function read()
    {
        $records = CrewMedicalRecord::where('status', 'ACT')->get();

        return response()->json( 
            [
                'records' => $records
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crew_medical_record = CrewMedicalRecord::find($id);
        $crew_name = $crew_medical_record->crew->full_name;

        if( $crew_medical_record ) {
            return response()->json([
                'status' => 200,
                'record' => $crew_medical_record,
                'crew_name' => $crew_name
            ]);
        } else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Medical Record Not Found'
            ]);
        }
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
        $validator = Validator::make($request->all(), [
            'id_crew' => 'required',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'blood_type' => 'required',
            'mcu_validity_date' => 'required',
            'mcu_expired' => 'required',
            'warning_period' => 'required',
            'history_of_pain' => 'required',
            'status' => 'required|max:3',
            'updated_user' => 'required'
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }
        else {
            $crew_medical = CrewMedicalRecord::find($id);

            if( $crew_medical ) {

                $crew_medical->id_crew = $request->id_crew;
                $crew_medical->height = $request->height;
                $crew_medical->weight = $request->weight;
                $crew_medical->mcu_validity_date = $request->mcu_validity_date;
                $crew_medical->mcu_expired = $request->mcu_expired;
                $crew_medical->history_of_pain = $request->history_of_pain;
                $crew_medical->status = $request->status;
                $crew_medical->updated_user = $request->updated_user;
                $crew_medical->warning_period = $request->warning_period;
                $crew_medical->blood_type = $request->blood_type;
                $crew_medical->save();

            return response()->json([
                'status' => 200,
                'message' => 'Crew Medical Record Has Been Updated'
            ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Medical Record Not Found'
                ]);
            }
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
        $medicalRecord = CrewMedicalRecord::find($id);

        if( $medicalRecord ) {   
            $medicalRecord->status = "DE";
            $medicalRecord->save();

            return response()->json([
                'status' => 200,
                'message' => 'Crew Medical Record Has Been Deleted',
            ]);
        }
        else{

            return response()->json([
                'status' => 404,
                'message' => 'Crew Medical Record Not Found'
            ]);

        }


        
    }
}
