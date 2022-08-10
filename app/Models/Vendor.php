<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
