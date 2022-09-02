<?php

namespace App\Http\Controllers;

use App\Models\CrewInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrewInsuranceController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'id_crew' => 'required',
            'insurance_name' => 'required',
            'account_number' => 'required|numeric',
            'insurance_type' => 'required',
            'name_of_heritage' => 'required',
            'remarks' => 'required',
            'status' => 'required|max:3'
        ] );

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }
        else {
            CrewInsurance::create( $request->all() );

            return response()->json([
                'status' => 200,
                'message' => 'Crew Insurance Added'
            ]);
        }
    }

    public function read()
    {
        return response()->json( [ 'crew_insurances' => CrewInsurance::where('status', 'ACT')->get() ] );
    }

    public function show($id)
    {
        $crew_insurance = CrewInsurance::find($id);

        if( $crew_insurance ) {
            return response()->json([
                'status' => 200,
                'crew_insurance' => $crew_insurance,
                'crew_name' => $crew_insurance->crew->full_name
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make( $request->all(), [
            'id_crew' => 'required',
            'insurance_name' => 'required',
            'account_number' => 'required|numeric',
            'insurance_type' => 'required',
            'name_of_heritage' => 'required',
            'remarks' => 'required',
            'status' => 'required|max:3'
        ] );

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }
        else
        {
            $crew_insurance = CrewInsurance::find($id);

            if( $crew_insurance ) {
                $crew_insurance->update( $request->all() );
                return response()->json([
                    'status' => 200,
                    'message' => "Crew Insurance Updated"
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data Not Found'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $crew_insurance = CrewInsurance::find($id);

        if( $crew_insurance ) {
            $crew_insurance->status = "DE";
            $crew_insurance->save();

            return response()->json([
                'status' => 200,
                'message' => "Crew Insurance Deleted"
            ]);
        }
        else {
            return response()->json([
                'message' => "Data Not Found",
                'status' => 404
            ]);
        }
    }
}
