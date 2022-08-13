<?php

namespace App\Models;

use Database\Factories\VendorFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'mst_vendor';
    protected $guarded = [''];
    public $incrementing = false; 
    protected $primaryKey = 'vendor_id';

    public function getRouteKeyName()
    {
        return 'vendor_id';
    }


    protected static function newFactory()
    {
        return VendorFactory::new();
    }
}
