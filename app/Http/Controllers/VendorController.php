<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

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
            'vendors' => DB::table('mst_vendor')->where('status', 'ACT')->orderBy('vendor_id')->get()

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
        $newVendor = $request->validate([
            'vendor_id' => 'required',
            'vendor_name' => 'required',
            'status' => 'required|max:3',
            'created_user' => 'required',
        ]);

        Vendor::create($newVendor);

        alert()->success('Success','Vendor Added Successfully');

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
        return view('dashboard.vendor.show', [
            'vendor' => Vendor::find($id)
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
        $newVendor = $request->validate([
            'vendor_id' => 'required',
            'vendor_name' => "required",
            'status' => 'required|max:3',
            'updated_user' => 'required'
        ]);

        if( Vendor::find($id)->update($newVendor) ) {
            alert()->success('Success','Vendor Updated Successfully');

            return redirect('/vendors');
        }

        alert()->error('Error','Failed To Update Vendor');

        return redirect('/vendors');
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

        $vendor->status = "DE";

        $vendor->save();

        alert()->success('Success',"Vendor Status Changed To 'DE'");

        return redirect('/vendors');
    }
}
