<?php

namespace App\Models;

use Database\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    protected $table = 'mst_country';
    protected $guarded = [''];
    public $incrementing = false; 
    protected $primaryKey = 'id_country';

    public function getRouteKeyName()
    {
        return 'id_country';
    }

    public function crew()
    {
        return $this->hasMany(Crew::class, 'country');
    }

    protected static function newFactory()
    {
        return CountryFactory::new();
    }
}
