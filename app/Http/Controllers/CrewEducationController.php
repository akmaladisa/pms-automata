<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use Illuminate\Http\Request;
use App\Models\CrewEducation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CrewEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.crew-education.index', [
            'crews' => Crew::where('status', 'ACT')->get(),
            'crew_education' => CrewEducation::where('status', 'ACT')->get()
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
            'instance_nm' => 'required',
            'scan_certificate' => ['mimes:pdf,docx,doc'],
            'more_information' => 'required',
            'year_in' => 'required|numeric',
            'year_out' => 'required|numeric',
            'status' => 'required',
            'created_user' => 'required',
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }
        else
        {
            $crew_education = new CrewEducation();
            $crew_education->id_crew = $request->id_crew;
            $crew_education->instance_nm = $request->instance_nm;

            if( $request->file('scan_certificate') ) {
                $crew_education->scan_certificate = $request->file('scan_certificate')->store('crew-scan-certificate');
            } 

            $crew_education->more_information = $request->more_information;
            $crew_education->year_in = $request->year_in;
            $crew_education->year_out = $request->year_out;
            $crew_education->status = $request->status;
            $crew_education->created_user = $request->created_user;


            $crew_education->save();

            return response()->json([
                'status' => 200,
                'message' => 'Crew Education Has Been Added'
            ]);
        }
    }

    public function read()
    {
        return response()->json([
            'crew_education' => CrewEducation::where('status', "ACT")->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crew_education = CrewEducation::find($id);
        $crew_name = $crew_education->crew->full_name;

        if( $crew_education ) {
            return response()->json([
                'status' => 200,
                'crew_education' => $crew_education,
                'crew_name' => $crew_name
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Crew Education Not Found'
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
        return view('dashboard.crew-education.edit', [
            'crew_education' => CrewEducation::find($id),
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
            'instance_nm' => 'required',
            'scan_certificate' => 'mimes:pdf,doc,docx',
            'more_information' => 'required',
            'year_in' => 'required|numeric',
            'year_out' => 'required|numeric',
            'status' => 'required|max:3',
            'updated_user' => 'required',
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag() 
            ]);
        } else {

            $crew_education = CrewEducation::find($id);

            if($crew_education) {
                $crew_education->id_crew = $request->id_crew;
                $crew_education->instance_nm = $request->instance_nm;
    
                if( $request->file('scan_certificate') ) {
                    Storage::delete( $crew_education->scan_certificate );
                    $crew_education->scan_certificate = $request->file('scan_certificate')->store('crew-scan-certificate');
                } 
    
                $crew_education->more_information = $request->more_information;
                $crew_education->year_in = $request->year_in;
                $crew_education->year_out = $request->year_out;
                $crew_education->status = $request->status;
                $crew_education->updated_user = $request->updated_user;
    
                $crew_education->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Crew Education Has Been Updated'
                ]);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Crew Education Not Found'
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
        $crew_edu = CrewEducation::find($id);
        if( $crew_edu ) {
            $crew_edu->status = "DE";
            $crew_edu->save();

            return response()->json([
                'status' => 200,
                'message' => "Crew Education Has Been Deleted"
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Crew Not Found'
            ]);
        }
    }
}
