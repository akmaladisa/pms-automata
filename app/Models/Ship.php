<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;
    protected $table = 'mst_ship';
    protected $primaryKey = 'id_ship';
    protected $fillable = ["id_ship", "ship_nm", "description", 'status','created_user','updated_user'];
    public $incrementing = false; 
    public function getRouteKeyName()
    {
        return 'id_ship';
    }
}
