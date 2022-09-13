<?php

namespace App\Http\Controllers;

use App\Models\MainGroup;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Validator;

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
    public function read()
    {
        return response()->json([
            'main_groups' => MainGroup::where('is_deleted', false)->orderBy('main_group_name')->get()
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
        $mainGroup = Validator::make($request->all(),[
            'kode_barang' => 'required',
            'main_group_name' => 'required',
            'created_user' => 'required'
        ]);

        if( $mainGroup->fails() ) {
            alert()->error("Error", $mainGroup->errors()->first());
            return redirect('/item');
        }
        
        MainGroup::create($request->all());

        alert()->success("Success", "Main Group Created Successfully");

        return redirect('/item');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( MainGroup::find($id) ) {
            return response()->json([
                'status' => 200,
                'main_group' => MainGroup::find($id)
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Not Found"
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
        $mainGroup = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'main_group_name' => 'required',
            'updated_user' => 'required'
        ]);

        if( $mainGroup->fails() ) {
            return response()->json([
                'errors' => $mainGroup->getMessageBag(),
                'status' => 400
            ]);
        }

        $old_main_group = MainGroup::find($id);

        if( $old_main_group ) {

            $old_main_group->update( $request->all() );

            return response()->json([
                'status' => 200,
                'message' => "Main Group has been updated"
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
        $mainGroup = MainGroup::find($id);

        if($mainGroup) {
            $mainGroup->is_deleted = true;
            $mainGroup->save();

            return response()->json([
                'status' => 200,
                'message' => "Main Group has been deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data Not Found"
        ]);
    }
}
