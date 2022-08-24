<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\JenisIdentitas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CrewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.crew.index', [
            'crew' => Crew::where('status', 'ACT')->get(),
            'crewId' => IdGenerator::generate([
                'table' => 'mst_crew',
                'length' => 8,
                'field' => 'id_crew',
                'prefix' => 'CR' 
            ]),
            'countries' => Country::all(),
            'identytiesType' => JenisIdentitas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.crew.create', [
            'crewId' => IdGenerator::generate([
                'table' => 'mst_crew',
                'length' => 8,
                'field' => 'id_crew',
                'prefix' => 'CR' 
            ]),
            'countries' => Country::all(),
            'identytiesType' => JenisIdentitas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_crew' => "required",
            'full_name' => 'required',
            'email' => 'required|email',
            'identity_type' => 'required',
            'identity_number' => 'required',
            'job_title' => 'required',
            'country' => 'required',
            'phone' => "required",
            'whatsapp_phone' => 'required',
            'gender' => 'required',
            'status_merital' => 'required',
            'pob' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'join_date' => 'required',
            'note' => 'required',
            'status' => 'required|max:3',
            'join_port' => 'required',
            'photo' => 'image|file|mimes:jpg,jpeg,png,gif',
            'created_user' => 'required'
        ]);

        if( $validator->fails() )
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator
            ]);
        }
        else
        {
            $crew = new Crew();
            $crew->id_crew = $request->id_crew;
            $crew->full_name = $request->full_name;
            $crew->email = $request->email;
            $crew->identity_type = $request->identity_type;
            $crew->identity_number = $request->identity_number;
            $crew->job_title = $request->job_title;
            $crew->country = $request->country;
            $crew->phone = $request->phone;
            $crew->whatsapp_phone = $request->whatsapp_phone;
            $crew->gender = $request->gender;
            $crew->status_merital = $request->status_merital;
            $crew->pob = $request->pob;
            $crew->dob = $request->dob;
            $crew->address = $request->address;
            $crew->join_date = $request->join_date;
            $crew->note = $request->note;
            $crew->status = $request->status;
            $crew->join_port = $request->join_port;

            if( $request->file('photo') ) {
                $crew->photo = $request->file('photo')->store('crew-img');
            }

            $crew->created_user = $request->created_user;

            $crew->save();

            alert()->success("Success", "Crew Added Successfully");
            
            return redirect()->route('crew.index');
        }
    }

    public function read()
    {
        return response()->json( [
            'crews' => Crew::where('status', 'ACT')->get()
        ] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crew = Crew::find($id);
        if($crew)
        {
            return response()->json([
                'status' => 200,
                'crew' => $crew
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Crew Not Found'
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
        $crew = Crew::find($id);
        if($crew)
        {
            return response()->json([
                'status' => 200,
                'crew' => $crew
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Crew Not Found'
            ]);
        }
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
        $validator = Validator::make($request->all(),[
            'id_crew' => "required",
            'full_name' => 'required',
            'email' => 'required|email',
            'identity_type' => 'required',
            'identity_number' => 'required',
            'job_title' => 'required',
            'country' => 'required',
            'phone' => "required",
            'whatsapp_phone' => 'required',
            'gender' => 'required',
            'status_merital' => 'required',
            'pob' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'join_date' => 'required',
            'note' => 'required',
            'status' => 'required|max:3',
            'join_port' => 'required',
            'photo' => 'image|file|mimes:jpg,jpeg,png,gif',
            'updated_user' => 'required'
        ]);

        if( $validator->fails() )
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator
            ]);
        }
        else
        {
            $crew = Crew::find($id);

            if( $crew )
            {
                $crew->id_crew = $request->id_crew;
                $crew->full_name = $request->full_name;
                $crew->email = $request->email;
                $crew->identity_type = $request->identity_type;
                $crew->identity_number = $request->identity_number;
                $crew->job_title = $request->job_title;
                $crew->country = $request->country;
                $crew->phone = $request->phone;
                $crew->whatsapp_phone = $request->whatsapp_phone;
                $crew->gender = $request->gender;
                $crew->status_merital = $request->status_merital;
                $crew->pob = $request->pob;
                $crew->dob = $request->dob;
                $crew->address = $request->address;
                $crew->join_date = $request->join_date;
                $crew->note = $request->note;
                $crew->status = $request->status;
                $crew->join_port = $request->join_port;
    
                if( $request->file('photo') ) {
                    Storage::delete( $crew->photo );
                    $crew->photo = $request->file('photo')->store('crew-img');
                }
    
                $crew->updated_user = $request->updated_user;
    
                $crew->save();
    
                return response()->json([
                    'status' => 200,
                    'message' => 'Crew Has Been Updated'
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Crew Not Found'
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

        $crew = Crew::find($id);

        if( $crew )
        {
            $crew->status = "DE";
            $crew->save();

            return response()->json([
                'status' => 200,
                'message' => "Crew Has Been Deleted",
                'crew' => $crew
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Crew Not Found'
            ]);
        }
        // $validator = Validator::make( $request->all(), [
        //     'id_crew' => "required",
        // ] );

        // if( $validator->fails() )
        // {
        //     return response()->json([
        //         'status' => 400,
        //         'errors' => $validator
        //     ]);
        // }
        // else
        // {
        //     $crew = Crew::find($id);

        //     if( $crew )
        //     {
        //         $crew->status = "DE";
        //         $crew->save();

        //         return response()->json([
        //             'status' => 200,
        //             'message' => 'Crew Has Been Deleted',
        //             'crew' => $crew
        //         ]);
        //     }
        //     else
        //     {
        //         return response()->json([
        //             'status' => 404,
        //             'message' => 'Crew Not Found'
        //         ]);
        //     }

        // }
    }
}
