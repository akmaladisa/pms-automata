<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewMedicalRecord extends Model
{
    use HasFactory;
    protected $table = 'mst_crew_medical_record';
    protected $guarded = ['id'];

    public function crew()
    {
        return $this->belongsTo(Crew::class, 'id_crew');
    }
}
