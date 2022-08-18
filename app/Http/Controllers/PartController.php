<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Unit;
use App\Models\Group;
use App\Models\SubGroup;
use App\Models\Component;
use App\Models\MainGroup;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.part.index', [
            'mainGroups' => MainGroup::all(),
            'groups' => Group::all(),
            'subGroups' => SubGroup::all(),
            'units' => Unit::all(),
            'components' => Component::where('is_deleted', false)->get(),
            'parts' => Part::where('is_deleted', false)->get(),
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
        $part = $request->validate([
            'code_part' => 'required|numeric|max:999999999999|min:100000000000',
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'code_unit' => "required|numeric|max:999999|min:100000",
            'code_component' => 'required|numeric|max:999999999|min:100000000',
            'part_name' => 'required',
            'is_deleted' => 'required|boolean',
            'created_user' => 'required'
        ]);

        if( Part::create($part) ) {
            alert()->success("Success", "Part Created Successfully");

            return redirect()->route('part.index');
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
        return view("dashboard.part.show", [
            'part' => Part::find($id)
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
        return view('dashboard.part.edit', [
            'part' => Part::find($id),
            'mainGroups' => MainGroup::all(),
            'groups' => Group::all(),
            'subGroups' => SubGroup::all(),
            'units' => Unit::all(),
            'components' => Component::where('is_deleted', false)->get(),
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
        $part = $request->validate([
            'code_part' => 'required|numeric|max:999999999999|min:100000000000',
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'code_unit' => "required|numeric|max:999999|min:100000",
            'code_component' => 'required|numeric|max:999999999|min:100000000',
            'part_name' => 'required',
            'is_deleted' => 'required|boolean',
            'updated_user' => 'required'
        ]);

        if( Part::find($id)->update($part) ) {
            alert()->success("Success", "Part Updated Successfully");

            return redirect()->route('part.index');
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
        $part = Part::find($id);
        $part->is_deleted = true;
        $part->save();

        alert()->success("Success", "Part Deleted Successfully");

        return redirect()->route('part.index');
    }
}
