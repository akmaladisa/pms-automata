<?php

namespace App\Models;

use App\Models\Crew;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrewWO extends Model
{
    use HasFactory;
    protected $table = 'mst_crew_wo';
    protected $guarded = ['id'];

    public function crew()
    {
        return $this->belongsTo(Crew::class, 'id_crew');
    }
}
