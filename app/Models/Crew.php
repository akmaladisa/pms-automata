<?php

namespace App\Models;

use App\Models\JenisIdentitas;
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
}
