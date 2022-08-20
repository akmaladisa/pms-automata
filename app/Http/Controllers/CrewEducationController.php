<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use Illuminate\Http\Request;
use App\Models\CrewEducation;
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
        $crew_education = $request->validate([
            'id_crew' => 'required',
            'instance_nm' => 'required',
            'scan_certificate' => 'mimes:pdf,doc,docx',
            'more_information' => 'required',
            'year_in' => 'required|numeric',
            'year_out' => 'required|numeric',
            'status' => 'required|max:3',
            'created_user' => 'required',
        ]);

        if( $request->file('scan_certificate') ) {
            $crew_education['scan_certificate'] = $request->file('scan_certificate')->store('crew-scan-certificate');
        }

        if( CrewEducation::create( $crew_education ) ) {
            alert()->success("Success", "Crew Education Created");

            return redirect()->route('crew-education.index');
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
        return view('dashboard.crew-education.show', [
            'crew_education' => CrewEducation::find($id)
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
        
        $crew_education = $request->validate([
            'id_crew' => 'required',
            'instance_nm' => 'required',
            'scan_certificate' => 'mimes:pdf,doc,docx',
            'more_information' => 'required',
            'year_in' => 'required|numeric',
            'year_out' => 'required|numeric',
            'status' => 'required|max:3',
            'updated_user' => 'required',
        ]);

        $old_crew_education = CrewEducation::find($id);

        if( $request->file('scan_certificate') ) {
            Storage::delete( $old_crew_education->scan_certificate );

            $crew_education['scan_certificate'] = $request->file('scan_certificate')->store('crew-scan-certificate');
        }

        $old_crew_education->update($crew_education);

        alert()->success("Success", "Crew Education Updated");

        return redirect()->route('crew-education.index');
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
        $crew_edu->status = "DE";
        $crew_edu->save();

        alert()->success("Success", "Crew Education Deleted");

        return redirect()->route('crew-education.index');
    }
}
