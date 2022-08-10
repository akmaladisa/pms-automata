<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $table = 'mst_departement';
    protected $guarded = [''];
    public $incrementing = false; 
    protected $primaryKey = 'departement_id';

    public function getRouteKeyName()
    {
        return 'departement_id';
    }
}
