<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Group;
use App\Models\SubGroup;
use App\Models\Component;
use App\Models\MainGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function read()
    {
        return response()->json([
            'components' => Component::orderBy('code_component')->get()
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
        $component = Validator::make($request->all(),[
            'code_component' => 'required|numeric|max:999999999|min:100000000',
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'code_unit' => "required|numeric|max:999999|min:100000",
            'component_name' => 'required',
            'created_user' => 'required'
        ]);

        if( $component->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $component->getMessageBag()
            ]);
        }

        Component::create($request->all());
        return response()->json([
            'status' => 200,
            'message' => "Component Created Successfully"
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
        $component = Component::find($id);
        $unit = $component->unit->unit_name;
        $sub_group = $component->subGroup->sub_group_name;
        $group = $component->group->group_name;
        $main_group = $component->mainGroup->main_group_name;

        if( $component ) {
            return response()->json([
                'status' => 200,
                'component' => $component,
                'sub_group' => $sub_group,
                'unit' => $unit,
                'group' => $group,
                'main_group' => $main_group,
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Component Not Found"
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
        $component = Validator::make($request->all(), [
            'code_component' => 'required|numeric|max:999999999|min:100000000',
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'code_unit' => "required|numeric|max:999999|min:100000",
            'component_name' => 'required',
            'updated_user' => 'required'
        ]);

        if( $component->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $component->getMessageBag()
            ]);
        }

        $old_component = Component::find($id);

        if($old_component) {
            $old_component->update( $request->all() );
            return response()->json([
                'status' => 200,
                'message' => "Component has been updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Component Not Found"
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
        $component = Component::find($id);

        if($component) {
            $component->delete();
            return response()->json([
                'status' => 200,
                'message' => "Component has been deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Component Not Found"
        ]);
    }
}
