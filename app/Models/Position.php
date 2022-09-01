<?php

namespace App\Models;

use Database\Factories\PositionFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;
    protected $table = 'positions';
    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return PositionFactory::new();
    }
}
