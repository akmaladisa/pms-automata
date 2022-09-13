<?php

namespace App\Http\Controllers;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class ItemMasterController extends Controller
{
    public function index()
    {
        return view('dashboard.master-item.index', [
            'item_code' => IdGenerator::generate([
                'table' => 'mst_item_main_group',
                'length' => 9,
                'field' => 'kode_barang',
                'prefix' => 'KDBRG' 
            ]),
        ]);
    }
}
