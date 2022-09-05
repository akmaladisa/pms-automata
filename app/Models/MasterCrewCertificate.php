<?php

namespace App\Models;

use Database\Factories\MasterCertificateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCrewCertificate extends Model
{
    use HasFactory;
    protected $table = 'master_crew_certificates';
    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return MasterCertificateFactory::new();
    }
}
