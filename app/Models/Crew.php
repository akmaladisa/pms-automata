<?php

namespace App\Models;

use App\Models\JenisIdentitas;
use Database\Factories\CrewFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Crew extends Model
{
    use HasFactory;
    protected $table = 'mst_crew';
    protected $guarded = [''];
    public $incrementing = false;
    protected $primaryKey = 'id_crew';

    public function getRouteKeyName()
    {
        return 'id_crew';
    }

    public function identity()
    {
        return $this->belongsTo(JenisIdentitas::class, 'identity_type');
    }

    public function crewCountry()
    {
        return $this->belongsTo(Country::class, 'country');
    }

    protected static function newFactory()
    {
        return CrewFactory::new();
    }
}
