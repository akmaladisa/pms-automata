<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
