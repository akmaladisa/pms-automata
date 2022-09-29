<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    public function index()
    {
        return view("dashboard.inventory.index");
    }

    public function read()
    {
        return response()->json([
            'inventories' => Inventory::where("status", 'ACT')->orderBy("ship_name")->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ship_name' => "required",
            'item_description' => "required",
            'part_no' => "required",
            'departement' => "required",
            'vendor' => "required",
            'stock' => "required|gte:stock_minimum",
            'unit_stock' => "required",
            'stock_minimum' => "required",
            'unit_stock_minimum' => "required",
            'location' => "required",
            "date" => "required",
            'remarks' => "required",
            'status' => "required|max:3"
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        Inventory::create( $request->all() );
        return response()->json([
            'status' => 200,
            'message' => "Inventory has been added"
        ]);
    }

    public function show($id)
    {
        if( Inventory::find($id) ) {
            return response()->json([
                'status' => 200,
                'inventory' => Inventory::find($id)
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ship_name' => "required",
            'item_description' => "required",
            'part_no' => "required",
            'departement' => "required",
            'vendor' => "required",
            'stock' => "required|gte:stock_minimum",
            'unit_stock' => "required",
            'stock_minimum' => "required",
            'unit_stock_minimum' => "required",
            'location' => "required",
            "date" => "required",
            'remarks' => "required",
            'status' => "required|max:3"
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        $inventory = Inventory::find($id);

        if($inventory) {
            $inventory->update( $request->all() );
            return response()->json([
                'status' => 200,
                'message' => "Inventory updated"
            ]);
        }

        
        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        if($inventory) {
            $inventory->status = "DE";
            $inventory->save();
            return response()->json([
                'status' => 200,
                'message' => "Inventory deleted"
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "Data not found"
        ]);
    }
}
