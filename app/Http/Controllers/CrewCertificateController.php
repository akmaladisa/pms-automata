<?php

namespace App\Http\Controllers;

use App\Models\CrewCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class CrewCertificateController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_crew' => 'required',
            'certificate_name' => 'required',
            'certificate_number' => 'required',
            'certificate_type' => 'required',
            'issued_at' => 'required',
            'certificate_scan' => 'mimes:pdf,doc,docx',
            'issued_date' => 'required',
            'expired_date' => 'required',
            'warning_periode' => 'required',
            'remarks' => 'required',
            'status' => 'required|max:3'
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }
        else
        {
            $crew_certificate = new CrewCertificate();
            $crew_certificate->id_crew = $request->id_crew;
            $crew_certificate->certificate_name = $request->certificate_name;
            $crew_certificate->certificate_number = $request->certificate_number;
            $crew_certificate->certificate_type = $request->certificate_type;
            $crew_certificate->issued_at = $request->issued_at;
            $crew_certificate->issued_date = $request->issued_date;
            $crew_certificate->expired_date = $request->expired_date;
            $crew_certificate->warning_periode = $request->warning_periode;
            $crew_certificate->remarks = $request->remarks;
            $crew_certificate->status = $request->status;

            if( $request->file('certificate_scan') ) {
                $crew_certificate->certificate_scan = $request->file('certificate_scan')->store('crew-scan-certificate');
            }
            $crew_certificate->save();

            return response()->json([
                'status' => 200,
                'message' => "Crew Certificate Added"
            ]);
        }
    }

    public function read()
    {
        return response()->json( [ 'crew_certificates' => CrewCertificate::where('status', 'ACT')->get() ] );
    }

    public function show($id)
    {
        $crew_certificate = CrewCertificate::find($id);

        if( $crew_certificate ) {
            return response()->json([
                'status' => 200,
                'crew_certificate' => $crew_certificate,
                'crew_name' => $crew_certificate->crew->full_name
            ]);
        }

        return response()->json([
            'status' => 400,
            'message' => "Data Not Found"
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_crew' => 'required',
            'certificate_name' => 'required',
            'certificate_number' => 'required',
            'certificate_type' => 'required',
            'issued_at' => 'required',
            'certificate_scan' => 'mimes:pdf,doc,docx',
            'issued_date' => 'required',
            'expired_date' => 'required',
            'warning_periode' => 'required',
            'remarks' => 'required',
            'status' => 'required|max:3'
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        $crew_certificate = CrewCertificate::find($id);

        if($crew_certificate) {
            $crew_certificate->id_crew = $request->id_crew;
            $crew_certificate->certificate_name = $request->certificate_name;
            $crew_certificate->certificate_number = $request->certificate_number;
            $crew_certificate->certificate_type = $request->certificate_type;
            $crew_certificate->issued_at = $request->issued_at;
            $crew_certificate->issued_date = $request->issued_date;
            $crew_certificate->expired_date = $request->expired_date;
            $crew_certificate->warning_periode = $request->warning_periode;
            $crew_certificate->remarks = $request->remarks;
            $crew_certificate->status = $request->status;

            if( $request->file('certificate_scan') ) {
                Storage::delete( $crew_certificate->certificate_scan );
                $crew_certificate->certificate_scan = $request->file('certificate_scan')->store('crew-scan-certificate');
            }
            $crew_certificate->save();

            return response()->json([
                'status' => 200,
                'message' => "Crew Certificate Updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data Not Found"
        ]);

    }

    public function destroy($id)
    {
        $crew_certificate = CrewCertificate::find($id);

        if($crew_certificate) {
            $crew_certificate->status = "DE";
            $crew_certificate->save();

            return response()->json([
                'status' => 200,
                'message' => "Crew Certificate Deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data Not Found"
        ]);
    }
}
