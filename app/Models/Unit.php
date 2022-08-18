<?php

namespace App\Models;

use Database\Factories\UnitFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'mst_item_unit';
    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = 'code_unit';

    public function getRouteKeyName()
    {
        return 'code_unit';
    }

    public function subGroup()
    {
        return $this->belongsTo(SubGroup::class, 'code_sub_group');
    } 

    public function group()
    {
        return $this->belongsTo(Group::class, 'code_group');
    }

    public function mainGroup()
    {
        return $this->belongsTo(MainGroup::class, 'code_main_group');
    }

    protected static function newFactory()
    {
        return UnitFactory::new();
    }

}

