<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainGroup extends Model
{
    use HasFactory;
    protected $table = 'mst_item_main_group';
    protected $guarded = [''];
    protected $primaryKey = 'kode_barang';
    public $incrementing = false; 


    public function getRouteKeyName()
    {
        return 'kode_barang';
    }
}
