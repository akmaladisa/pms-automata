<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\MainGroup;
use App\Models\SubGroup;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.unit.index", [
            'mainGroups' => MainGroup::all(),
            'groups' => Group::all(),
            'subGroups' => SubGroup::all(),
            'units' => Unit::all()
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
        $unit = $request->validate([
            'code_unit' => "required|numeric|max:999999|min:100000",
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'unit_name' => 'required',
            'created_user' => 'required'
        ]);

        if( Unit::create($unit) ) {
            alert()->success("Success", "Unit Created Successfully");

            return redirect()->route('unit.index');
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
        return view('dashboard.unit.show', [
            'unit' => Unit::find($id)
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
        return view('dashboard.unit.edit', [
            'unit' => Unit::find($id),
            'mainGroups' => MainGroup::all(),
            'groups' => Group::all(),
            'subGroups' => SubGroup::all(),
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
        $unit = $request->validate([
            'code_unit' => "required|numeric|max:999999|min:100000",
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'unit_name' => 'required',
            'updated_user' => 'required'
        ]);

        if( Unit::find($id)->update($unit) ) {
            alert()->success("Success", "Unit Updated Successfully");

            return redirect()->route('unit.index');
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
        Unit::find($id)->delete();

        alert()->success("Success", 'Unit Deleted Successfully');

        return redirect()->route('unit.index');
    }
}
