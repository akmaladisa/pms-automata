<?php

namespace App\Models;

use Database\Factories\JenisIdentitasFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisIdentitas extends Model
{
    use HasFactory;
    protected $table = 'jenis_identitas';
    protected $guarded  =['id'];


    public function crew()
    {
        return $this->hasMany(Crew::class, 'identity_type');
    }

    protected static function newFactory()
    {
        return JenisIdentitasFactory::new();
    }
}
