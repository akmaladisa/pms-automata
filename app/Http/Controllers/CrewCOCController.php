<?php

namespace App\Http\Controllers;

use App\Models\CrewCOC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CrewCOCController extends Controller
{
    public function read()
    {
        return response()->json([
            'crew_cocs' => CrewCOC::where('status', 'ACT')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'id_crew' => 'required',
            'certificate_rank' => 'required',
            'certificate_number' => 'required',
            'confirmed' => 'required',
            'institution_name' => 'required',
            'certificate_scan' => 'mimes:pdf,docx,doc',
            'remarks' => 'required',
            'status' => 'required|max:3'
        ] );

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        $coc = new CrewCOC();
        $coc->id_crew = $request->id_crew;
        $coc->certificate_rank = $request->certificate_rank;
        $coc->certificate_number = $request->certificate_number;
        $coc->confirmed = $request->confirmed;
        $coc->institution_name = $request->institution_name;
        $coc->remarks = $request->remarks;
        $coc->status = $request->status;
        
        if( $request->file('certificate_scan') ) {
            $coc->certificate_scan = $request->file('certificate_scan')->store('crew-coc');
        }

        $coc->save();

        return response()->json([
            'status' => 200,
            'message' => "Crew COC added"
        ]);
    }

    public function show($id)
    {
        $coc = CrewCOC::find($id);
        if( $coc ) {
            $crew_name = $coc->crew->full_name;
            return response()->json([
                'status' => 200,
                'crew_coc' => $coc,
                'crew_name' => $crew_name
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make( $request->all(), [
            'id_crew' => 'required',
            'certificate_rank' => 'required',
            'certificate_number' => 'required',
            'confirmed' => 'required',
            'institution_name' => 'required',
            'certificate_scan' => 'mimes:pdf,docx,doc',
            'remarks' => 'required',
            'status' => 'required|max:3'
        ] );

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        $coc = CrewCOC::find($id);

        if( $coc ) {
            $coc->id_crew = $request->id_crew;
            $coc->certificate_rank = $request->certificate_rank;
            $coc->certificate_number = $request->certificate_number;
            $coc->confirmed = $request->confirmed;
            $coc->institution_name = $request->institution_name;
            $coc->remarks = $request->remarks;
            $coc->status = $request->status;

            if( $request->file('certificate_scan') ) {
                Storage::delete($coc->certificate_scan);
                $coc->certificate_scan = $request->file('certificate_scan')->store('crew-coc');
            }

            $coc->save();

            return response()->json([
                'status' => 200,
                'message' => "Crew COC updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }

    public function destroy($id)
    {
        $coc = CrewCOC::find($id);
        if( $coc ) {
            $coc->status = "DE";
            $coc->save();
            return response()->json([
                'status' => 200,
                'message' => "Crew COC deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }
}
