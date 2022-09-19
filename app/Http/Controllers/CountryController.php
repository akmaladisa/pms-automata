<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.country.index', [
            'countryId' => IdGenerator::generate([
                'table' => 'mst_country',
                'length' => 8,
                'field' => 'id_country',
                'prefix' => 'CNM' 
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read()
    {
        return response()->json( [ 'countries' => Country::where('status', 'ACT')->orderBy('country_nm')->get() ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = $request->validate([
            'id_country' => 'required',
            'country_nm' => 'required',
            'description' => 'required',
            'status' => 'required|max:3',
            'created_user' => 'required'
        ]);

        Country::create($country);

        alert()->success('Success', "Country Added Successfully");

        return redirect('/country');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( Country::find($id) ) {
            return response()->json([
                'status' => 200,
                'country' => Country::find($id)
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Country not found'
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
        return view("dashboard.country.edit", [
            'country' => Country::find($id)
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
        $country = Validator::make($request->all(), [
            'id_country' => 'required',
            'country_nm' => 'required',
            'description' => 'required',
            'status' => 'required|max:3',
            'updated_user' => 'required'
        ]);

        if( $country->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $country->getMessageBag()
            ]);
        }

        $cntry = Country::find($id);

        if( $cntry ) {
            $cntry->update( $request->all() );
            return response()->json([
                'status' => 200,
                'message' => "Country has been updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Country not found'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);

        if( $country ) {
            $country->status = "DE";
            $country->save();
            return response()->json([
                'status' => 200,
                'message' => "Country has been deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Country not found'
        ]);
    }
}
