<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}

