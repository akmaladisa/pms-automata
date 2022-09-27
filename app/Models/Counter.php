<?php

namespace App\Models;

use Database\Factories\CounterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'counters';

    protected static function newFactory()
    {
        return CounterFactory::new();
    }
}
