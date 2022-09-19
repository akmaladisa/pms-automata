<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Group;
use App\Models\MainGroup;
use App\Models\Part;
use App\Models\SubGroup;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function read()
    {
        return response()->json([
            'units' => Unit::orderBy('code_unit')->get()
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
        $unit = Validator::make($request->all(), [
            'code_unit' => "required|numeric|max:999999|min:100000",
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'unit_name' => 'required',
            'created_user' => 'required'
        ]);

        if( $unit->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $unit->getMessageBag()
            ]);
        }

        Unit::create( $request->all() );
        return response()->json([
            'status' => 200,
            'message' => "Unit Created Successfully"
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
        $unit = Unit::find($id);
        $sub_group = $unit->code_sub_group == 'null' ? $unit->code_sub_group: $unit->subGroup->sub_group_name;
        $group = $unit->code_group == 'null' ? $unit->code_group : $unit->group->group_name;
        $main_group = $unit->code_main_group == 'null' ? $unit->code_main_group : $unit->mainGroup->main_group_name;

        if( $unit ) {
            return response()->json([
                'status' => 200,
                'unit' => $unit,
                'sub_group' => $sub_group,
                'group' => $group,
                'main_group' => $main_group
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Unit Not Found"
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
        $unit = Validator::make($request->all(), [
            'code_unit' => "required|numeric|max:999999|min:100000",
            'code_main_group' => 'required|numeric|max:9|min:1',
            'code_group' => 'required|numeric|max:99|min:10',
            'code_sub_group' => 'required|numeric|max:999|min:100',
            'unit_name' => 'required',
            'updated_user' => 'required'
        ]);

        if( $unit->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $unit->getMessageBag()
            ]);
        }

        $old_unit = Unit::find($id);

        if( $old_unit ) {
            $old_unit->update( $request->all() );
            return response()->json([
                'status' => 200,
                'message' => "Unit Has Been Updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Unit Not Found"
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
        $unit = Unit::find($id);

        Component::where('code_unit', $id)->update(['code_unit' => 'null']);
        Part::where('code_unit', $id)->update(['code_unit' => 'null']);

        if( $unit ) {
            $unit->delete();
            return response()->json([
                'message' => "Unit Has Been Deleted",
                'status' => 200
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Unit Not Found"
        ]);
    }
}
