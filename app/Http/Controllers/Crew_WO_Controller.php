<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\CrewWO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Crew_WO_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.crew-wo.index", [
            'crews' => Crew::where('status', 'ACT')->get(),
            'crew_wo' => CrewWO::where('status', 'ACT')->get()
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

    public function read()
    {
        return response()->json([
            'crew_wo' => CrewWO::where('status', 'ACT')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_crew' => 'required',
            'company_nm' => 'required',
            'last_position' => 'required',
            'year_in' => 'required|numeric',
            'year_out' => 'required|numeric',
            'certificate' => 'mimes:pdf,doc,docx',
            'remarks' => 'required',
            'status' => 'required|max:3',
            'created_user' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        } else {
            $crew_wo = new CrewWO();
            $crew_wo->id_crew = $request->id_crew;
            $crew_wo->company_nm = $request->company_nm;
            $crew_wo->last_position = $request->last_position;
            $crew_wo->year_in = $request->year_in;
            $crew_wo->year_out = $request->year_out;
            $crew_wo->remarks = $request->remarks;
            $crew_wo->status = $request->status;
            $crew_wo->created_user = $request->created_user;

            if($request->file('certificate')) {
                $crew_wo->certificate = $request->file('certificate')->store('crew-scan-certificate');
            }

            $crew_wo->save();

            return response()->json([
                'status' => 200,
                'message' => 'Crew Work Experience Has Been Added'
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
        $crew_wo = CrewWO::find($id);
        $crew_name = $crew_wo->crew->full_name;

        if ($crew_wo) {
            return response()->json([
                'status' => 200,
                'crew_wo' => $crew_wo,
                'crew_name' => $crew_name
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'messages' => 'Crew Work Experience Not Found'
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
        return view('dashboard.crew-wo.edit', [
            'crews' => Crew::where('status', 'ACT')->get(),
            'crew_wo' => CrewWO::find($id)
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
            'company_nm' => 'required',
            'last_position' => 'required',
            'year_in' => 'required|numeric',
            'year_out' => 'required|numeric',
            'certificate' => 'mimes:pdf,doc,docx',
            'remarks' => 'required',
            'status' => 'required|max:3',
            'updated_user' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        } else {
            $crew_wo = CrewWO::find($id);

            if ($crew_wo) {
                $crew_wo->id_crew = $request->id_crew;
                $crew_wo->company_nm = $request->company_nm;
                $crew_wo->last_position = $request->last_position;
                $crew_wo->year_in = $request->year_in;
                $crew_wo->year_out = $request->year_out;
                $crew_wo->remarks = $request->remarks;
                $crew_wo->status = $request->status;
                $crew_wo->updated_user = $request->updated_user;

                if($request->file('certificate')) {
                    Storage::delete($crew_wo->certificate);
                    $crew_wo->certificate = $request->file('certificate')->store('crew-scan-certificate');
                }

                $crew_wo->save();

                return response()->json([
                    'status' => 200,
                    'message' => "Crew Work Experience Has Been Updated"
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Crew Work Experience Not Found'
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
        $crew_wo = CrewWO::find($id);

        if ($crew_wo) {
            $crew_wo->status = "DE";
            $crew_wo->save();

            return response()->json([
                'status' => 200,
                'message' => 'Crew Work Experience Deleted'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Crew Work Experience Not Found'
            ]);
        }
    }
}
