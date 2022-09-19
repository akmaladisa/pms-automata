<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.vendor.index', [
            'vendorId' => IdGenerator::generate([
                'table' => 'mst_vendor',
                'length' => 7,
                'field' => 'vendor_id',
                'prefix' => 'VID' 
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read()
    {
        return response()->json([ 'vendors' => Vendor::where('status', 'ACT')->orderBy("vendor_name")->get() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newVendor = $request->validate([
            'vendor_id' => 'required',
            'vendor_name' => 'required',
            'status' => 'required|max:3',
            'created_user' => 'required',
        ]);

        Vendor::create($newVendor);

        alert()->success('Success','Vendor Added Successfully');

        return redirect('/vendors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( Vendor::find($id) ) {
            return response()->json([
                'vendor' => Vendor::find($id),
                'status' => 200
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Vendor not found"
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
        return view('dashboard.vendor.edit', [
            'vendor' => Vendor::find($id)
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
        $newVendor = Validator::make($request->all(),[
            'vendor_id' => 'required',
            'vendor_name' => "required",
            'status' => 'required|max:3',
            'updated_user' => 'required'
        ]);

        if( $newVendor->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $newVendor->getMessageBag()
            ]);
        }

        $vndr = Vendor::find($id);

        if( $vndr ) {
            $vndr->update( $request->all() );
            return response()->json([
                'status' => 200,
                'message' => "Vendor has been updated"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Vendor not found"
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
        $vendor = Vendor::find($id);

        if( $vendor ) {
            $vendor->status = "DE";
            $vendor->save();
            return response()->json([
                'status' => 200,
                'message' => "Vendor has been deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Vendor not found"
        ]);
    }
}
