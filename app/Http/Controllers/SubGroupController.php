<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\SubGroup;
use App\Models\MainGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.sub-group.index", [
            'mainGroups' => MainGroup::all(),
            'groups' => Group::all(),
            'subGroups' => SubGroup::all(),
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
            'sub_groups' => SubGroup::orderBy('code_sub_group')->get()
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
        $subGroup = Validator::make($request->all(),[
            'code_sub_group' => "required|numeric|min:100|max:999",
            'code_main_group' => 'required|numeric|min:1|max:9',
            'code_group' => "required|numeric|min:10|max:99",
            'sub_group_name' => "required",
            'created_user' => "required"
        ]);

        if( $subGroup->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $subGroup->getMessageBag()
            ]);
        }

        SubGroup::create( $request->all() );
        return response()->json([
            'status' => 200,
            'message' => "Sub Group Created Successfully"
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
        $subGroup = SubGroup::find($id);
        $mainGroup = $subGroup->mainGroup->main_group_name ? $subGroup->mainGroup->main_group_name : null;
        $group = $subGroup->group->group_name ? $subGroup->group->group_name : null;

        if( $subGroup ) {
            return response()->json([
                'status' => 200,
                'sub_group' => $subGroup,
                'main_group' => $mainGroup,
                'group' => $group
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
        return view("dashboard.sub-group.edit", [
            'mainGroups' => MainGroup::all(),
            'groups' => Group::all(),
            'subGroup' => SubGroup::find($id)
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
        $subGroup = Validator::make($request->all(),[
            'code_sub_group' => "required|numeric|min:100|max:999",
            'code_main_group' => 'required|numeric|min:1|max:9',
            'code_group' => "required|numeric|min:10|max:99",
            'sub_group_name' => "required",
            'updated_user' => "required"
        ]);

        if( $subGroup->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $subGroup->getMessageBag()
            ]);
        }

        $old_sub_group = SubGroup::find($id);

        if( $old_sub_group ) {
            $old_sub_group->update( $request->all() );
            return response()->json([
                'status' => 200,
                'message' => "Sub Group has been updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data Not Found"
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
        $subGroup = SubGroup::find($id);

        if( $subGroup ) {
            $subGroup->delete();
            return response()->json([
                'message' => "Sub Group has been deleted",
                'status' => 200
            ]);
        }

        return response()->json([
            'message' => "Data Not Found",
            'status' => 404
        ]);
    }
}
