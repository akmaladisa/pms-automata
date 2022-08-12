<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasOne(Crew::class, 'country');
    }

}
