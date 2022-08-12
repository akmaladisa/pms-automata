<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipAccess extends Model
{
    use HasFactory;
    protected $table = 'tbl_akses_ship';
    protected $guarded = ['id'];
}
