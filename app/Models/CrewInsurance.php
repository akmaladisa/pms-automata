<?php

namespace App\Models;

use App\Models\Crew;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrewInsurance extends Model
{
    use HasFactory;
    protected $table = 'crew_insurances';
    protected $guarded = ['id'];

    public function crew()
    {
        return $this->belongsTo(Crew::class, 'id_crew');
    }
}
