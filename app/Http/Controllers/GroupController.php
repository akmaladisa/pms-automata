<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\MainGroup;
use Illuminate\Http\Request;

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
        $group = $request->validate([
            'code_group' => "required|numeric|max:99|min:10",
            'code_main_group' => "required|numeric|max:9|min:1",
            'group_name' => 'required',
            'created_user' => 'required'
        ]);

        if( Group::create($group) ) {
            alert()->success("Success", "Group Added Successfully");

            return redirect()->route('group.index');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.group.show', [
            'group' => Group::find($id)
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
        $group = $request->validate([
            'code_group' => "required|numeric|max:99|min:10",
            'code_main_group' => "required|numeric|max:9|min:1",
            'group_name' => 'required',
            'updated_user' => 'required'
        ]);

        Group::find($id)->update($group);

        alert()->success("Success", "Group Edited Successfully");

        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::find($id)->delete();

        alert()->success("Success", "Group Deleted Successfully");

        return redirect()->route('group.index');
    }
}
