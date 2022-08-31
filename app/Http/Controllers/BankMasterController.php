<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankMasterController extends Controller
{
    public function index()
    {
        return view('dashboard.bank.index');
    }

    public function read()
    {
        return response()->json([
            'banks' => Bank::all()
        ]);
    }

    public function edit($id)
    {
        if( Bank::find($id) ) {
            return response()->json([
                'status' => 200,
                'bank' => Bank::find($id)
            ]);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => "Bank Not Found"
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        if( Bank::create($request->all()) )
        {
            return response()->json([
                'status' => 200,
                'message' => 'Bank Has Been Added'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Failed To Add Bank'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $bank = Bank::find($id);

        if($bank) {
            $bank->update($request->all());
            return response()->json([
                'status' => 200,
                'message' => 'Bank Has Been Updated'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'bank not found'
            ]);
        }
    }

    public function destroy($id)
    {
        $bank = Bank::find($id);

        if($bank) {
            $bank->delete();
            return response()->json([
                'status' => 200,
                'message' => "Bank Has Been Deleted"
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Bank not found"
            ]);
        }
    }
}
