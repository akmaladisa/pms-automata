<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\MainGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.group.index', [
            'groups' => Group::all(),
            'mainGroups' => MainGroup::all()
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
            'groups' => Group::orderBy('code_group')->get()
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
        $group = Validator::make($request->all(),[
            'code_group' => "required|numeric|max:99|min:10",
            'code_main_group' => "required|numeric|max:9|min:1",
            'group_name' => 'required',
            'created_user' => 'required'
        ]);

        if( $group->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $group->getMessageBag()
            ]);
        }

        Group::create( $request->all() );

        return response()->json([
            'status' => 200,
            'message' => "Group created successfully"
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
        $group = Group::find($id);
        $main_group = $group->mainGroup->main_group_name;

        if( $group ) {
            return response()->json([
                'status' => 200,
                'group' => $group,
                'main_group' => $main_group
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Group Not Found"
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
        return view('dashboard.group.edit', [
            'group' => Group::find($id),
            'mainGroups' => MainGroup::all()
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
        $group = Validator::make($request->all(), [
            'code_group' => "required|numeric|max:99|min:10",
            'code_main_group' => "required|numeric|max:9|min:1",
            'group_name' => 'required',
            'updated_user' => 'required'
        ]);

        if( $group->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $group->getMessageBag()
            ]);
        }

        $old_group = Group::find($id);

        if( $old_group ) {
            $old_group->update( $request->all() );

            return response()->json([
                'status' => 200,
                'message' => "Group has been updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Group not found"
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
        $group = Group::find($id);

        if($group) {
            $group->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Group has been deleted'
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Group not found"
        ]);
    }
}
