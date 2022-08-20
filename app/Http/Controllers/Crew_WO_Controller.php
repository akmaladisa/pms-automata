<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\CrewWO;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $crew_wo = $request->validate([
            'id_crew' => 'required',
            'company_nm' => 'required',
            'last_position' => 'required',
            'year_in' => 'required|numeric',
            'year_out' => 'required|numeric',
            'jobs_status' => 'required',
            'more_info' => 'required',
            'status' => 'required|max:3',
            'created_user' => 'required'
        ]);

        if( CrewWO::create($crew_wo) ) {
            alert()->success("Success", "Crew WO created");

            return redirect()->route('crew-wo.index'); 
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
        return view('dashboard.crew-wo.show', [
            'crew_wo' => CrewWO::find($id)
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
        $crew_wo = $request->validate([
            'id_crew' => 'required',
            'company_nm' => 'required',
            'last_position' => 'required',
            'year_in' => 'required|numeric',
            'year_out' => 'required|numeric',
            'jobs_status' => 'required',
            'more_info' => 'required',
            'status' => 'required|max:3',
            'updated_user' => 'required'
        ]);

        if( CrewWO::find($id)->update($crew_wo) ) {
            alert()->success("Success", "Crew WO updated");

            return redirect()->route('crew-wo.index');
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
        $crew_wo->status = "DE";
        $crew_wo->save();

        alert()->success("Success", "Crew WO deleted");

        return redirect()->route('crew-wo.index');
    }
}
