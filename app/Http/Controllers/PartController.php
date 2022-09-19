<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Unit;
use App\Models\Group;
use App\Models\SubGroup;
use App\Models\Component;
use App\Models\MainGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function read()
    {
        return response()->json([
            'parts' => Part::orderBy('code_part')->get()
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
        $part = Validator::make($request->all(), [
            'code_part' => 'required|numeric|max:999999999999|min:100000000000',
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'code_unit' => "required|numeric|max:999999|min:100000",
            'code_component' => 'required|numeric|max:999999999|min:100000000',
            'part_name' => 'required',
            'created_user' => 'required'
        ]);

        if( $part->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $part->getMessageBag()
            ]);
        }

        Part::create( $request->all() );
        return response()->json([
            'status' => 200,
            'message' => "Part Created Successfully"
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
        $part = Part::find($id);
        $main_group = $part->code_main_group == 'null' ? $part->code_main_group : $part->mainGroup->main_group_name;
        $group = $part->code_group == 'null' ? $part->code_group : $part->group->group_name;
        $sub_group = $part->code_sub_group == 'null' ? $part->code_sub_group : $part->subGroup->sub_group_name;
        $unit = $part->code_unit == 'null' ? $part->code_unit : $part->unit->unit_name;
        $component = $part->code_component == 'null' ? $part->code_component : $part->component->component_name;

        if( $part ) {
            return response()->json([
                'status' => 200,
                'part' => $part,
                'main_group' => $main_group,
                'group' => $group,
                'sub_group' => $sub_group,
                'unit' => $unit,
                'component' => $component,
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
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
        $part = Validator::make($request->all(), [
            'code_part' => 'required|numeric|max:999999999999|min:100000000000',
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'code_unit' => "required|numeric|max:999999|min:100000",
            'code_component' => 'required|numeric|max:999999999|min:100000000',
            'part_name' => 'required',
            'updated_user' => 'required'
        ]);

        if( $part->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $part->getMessageBag()
            ]);
        }

        $old_part = Part::find($id);
        
        if( $old_part ) {
            $old_part->update( $request->all() );
            return response()->json([
                'status' => 200,
                'message' => "Part has been updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
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
        $part = Part::find($id);
        if( $part ) {
            $part->delete();
            return response()->json([
                'status' => 200,
                'message' => "Part has been deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }
}
