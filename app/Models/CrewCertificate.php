<?php

namespace App\Models;

use App\Models\Crew;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrewCertificate extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'crew_certificates';

    public function crew()
    {
        return $this->belongsTo(Crew::class, 'id_crew');
    }
}
