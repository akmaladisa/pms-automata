<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Group;
use App\Models\MainGroup;
use App\Models\SubGroup;
use App\Models\Unit;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.component.index", [
            'mainGroups' => MainGroup::all(),
            'groups' => Group::all(),
            'subGroups' => SubGroup::all(),
            'units' => Unit::all(),
            'components' => Component::where('is_deleted',false)->get()
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
        $component = $request->validate([
            'code_component' => 'required|numeric|max:999999999|min:100000000',
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'code_unit' => "required|numeric|max:999999|min:100000",
            'component_name' => 'required',
            'is_deleted' => 'required|boolean',
            'created_user' => 'required'
        ]);

        if( Component::create($component) ) {
            alert()->success("Success", "Component Created Successfully");

            return redirect()->route('component.index');
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
        return view("dashboard.component.show", [
            'component' => Component::find($id),
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
        return view('dashboard.component.edit', [
            'component' => Component::find($id),
            'mainGroups' => MainGroup::all(),
            'groups' => Group::all(),
            'subGroups' => SubGroup::all(),
            'units' => Unit::all(),
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
        $component = $request->validate([
            'code_component' => 'required|numeric|max:999999999|min:100000000',
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'code_unit' => "required|numeric|max:999999|min:100000",
            'component_name' => 'required',
            'is_deleted' => 'required|boolean',
            'updated_user' => 'required'
        ]);

        if( Component::find($id)->update($component) ) {
            alert()->success("Success", "Component Updated Successfully");

            return redirect()->route('component.index');
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
        //
    }
}
