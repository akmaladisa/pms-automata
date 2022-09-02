<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCrewCertificate extends Model
{
    use HasFactory;
    protected $table = 'master_crew_certificates';
    protected $guarded = ['id'];
}
