<?php

namespace App\Http\Controllers;

use App\Models\MainGroup;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class MainGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.main-group.index', [
            'kode_barang' => IdGenerator::generate([
                'table' => 'mst_item_main_group',
                'length' => 9,
                'field' => 'kode_barang',
                'prefix' => 'KDBRG' 
            ]),
            'mainGroup' => MainGroup::all()
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
        $mainGroup = $request->validate([
            'kode_barang' => 'required',
            'code_main_group' => 'required|numeric|max:9|min:1',
            'main_group_name' => 'required',
            'created_user' => 'required'
        ]);

        MainGroup::create($mainGroup);

        alert()->success("Success", "Main Group Created Successfully");

        return redirect()->route('main-group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.main-group.show', [
            'mainGroup' => MainGroup::find($id)
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
        return view("dashboard.main-group.edit", [
            'mainGroup' => MainGroup::find($id)
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
        $mainGroup = $request->validate([
            'kode_barang' => 'required',
            'code_main_group' => 'required|numeric|max:9|min:1',
            'main_group_name' => 'required',
            'updated_user' => 'required'
        ]);

        MainGroup::find($id)->update($mainGroup);

        alert()->success("Success", "Main Group Updated Successfully");

        return redirect()->route('main-group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MainGroup::find($id)->delete();

        alert()->success("Success", "Main Group Deleted Successfully");

        return redirect()->route('main-group.index');
    }
}
