<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewInsurance extends Model
{
    use HasFactory;
    protected $table = 'crew_insurances';
    protected $guarded = ['id'];
}
