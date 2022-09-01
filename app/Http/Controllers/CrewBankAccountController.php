<?php

namespace App\Http\Controllers;

use App\Models\CrewBankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrewBankAccountController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_crew' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required|numeric',
            'account_name' => 'required',
            'salary_transfer' => 'required',
            'remarks' => 'required',
            'status' => 'required'
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        } else {
            CrewBankAccount::create( $request->all() );

            return response()->json([
                'status' => 200,
                'message' => 'Crew Bank Account Added'
            ]);
        }
    }

    public function show($id)
    {
        $crew_bank = CrewBankAccount::find($id);
        $crew_name = $crew_bank->crew->full_name;

        if( $crew_bank ) {
            return response()->json( [
                'status' => 200,
                'crew_bank' => $crew_bank,
                'crew_name' => $crew_name
            ] );
        } 
        else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found'
            ]);
        }
    }

    public function read()
    {
        return response()->json( ['crew_bank_accounts' => CrewBankAccount::where('status', 'ACT')->get()] );
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_crew' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required|numeric',
            'account_name' => 'required',
            'salary_transfer' => 'required',
            'remarks' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }
        else
        {
            $crew_bank = CrewBankAccount::find($id);

            if( $crew_bank ) {
                $crew_bank->update($request->all());

                return response()->json( [
                    'status' => 200,
                    'message' => 'Crew Bank Account Updated'
                ] );
            } 
            else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data Not Found'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $crew_bank = CrewBankAccount::find($id);
        
        if($crew_bank)
        {
            $crew_bank->status = "DE";
            $crew_bank->save();

            return response()->json([
                'message' => 'Crew Bank Account Deleted',
                'status' => 200
            ]);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found'
            ]);
        }
    }
}
