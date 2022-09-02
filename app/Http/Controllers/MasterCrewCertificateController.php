<?php

namespace App\Http\Controllers;

use App\Models\MasterCrewCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterCrewCertificateController extends Controller
{
    public function index()
    {
        return view('dashboard.crew-certificate-master.index');
    }

    public function read()
    {
        return response()->json(['crew_certificate_master' => MasterCrewCertificate::all()]);
    }

    public function edit($id)
    {
        $data = MasterCrewCertificate::find($id);

        if( $data )
        {
            return response()->json([
                'status' => 200,
                'data' => $data
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data Not Found"
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required'
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        MasterCrewCertificate::create( $request->all() );

        return response()->json([
            'status' => 200,
            'message' => 'Certificate Has Been Added'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required'
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        $old_data = MasterCrewCertificate::find($id);

        if($old_data)
        {
            $old_data->update($request->all());

            return response()->json([
                'status' => 200,
                'message' => "Certificate Updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data Not Found"
        ]);

    }

    public function destroy($id)
    {
        $old_data = MasterCrewCertificate::find($id);
        
        if($old_data) {
            $old_data->delete();

            return response()->json([
                'status' => 200,
                'message' => "Certificate Deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data Not Found"
        ]);
    }
}
