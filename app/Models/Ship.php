<?php

namespace App\Models;

use App\Models\Crew;
use Database\Factories\ShipFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected static function newFactory()
    {
        return ShipFactory::new();
    }

    public function crew()
    {
        return $this->hasMany(Crew::class, 'duty_on_ship');
    }
}
