<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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
            'countries' => DB::table('mst_country')->where('status', 'ACT')->orderBy('id_country')->get(),
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
        return view('dashboard.country.show', [
            'country' => Country::find($id)
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
        $country = $request->validate([
            'id_country' => 'required',
            'country_nm' => 'required',
            'description' => 'required',
            'status' => 'required|max:3',
            'updated_user' => 'required'
        ]);

        if( Country::find($id)->update($country) ) {
            alert()->success("Success", 'Ship Updated Successfully');

            return redirect("/country");
        }

        alert()->error('Error','Failed To Update Country');

        return redirect('/country');
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

        $country->status = "DE";

        $country->save();

        alert()->success('Success', "Country Status Changed To 'DE'");

        return redirect('/country');
    }
}
