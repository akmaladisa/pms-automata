<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewBankAccount extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'crew_bank_accounts';

    public function crew()
    {
        return $this->belongsTo(Crew::class, 'id_crew');
    }
}
