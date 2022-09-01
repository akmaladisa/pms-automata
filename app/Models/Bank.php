<?php

namespace App\Models;

use Database\Factories\BankFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'banks';
    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return BankFactory::new();
    }
}
