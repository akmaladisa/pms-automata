<?php

namespace App\Models;

use App\Models\Crew;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipAccess extends Model
{
    use HasFactory;
    protected $table = 'tbl_akses_ship';
    protected $guarded = ['id'];

    public function crew()
    {
        return $this->belongsTo(Crew::class, 'id_crew');
    }

    public function ship()
    {
        return $this->belongsTo(Ship::class, 'id_ship');
    }
}
