<?php

namespace App\Models;

use App\Models\Group;
use App\Models\MainGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Component extends Model
{
    use HasFactory;
    protected $table = 'mst_item_component';
    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = 'code_component';

    public function getRouteKeyName()
    {
        return 'code_component';
    }

    public function mainGroup()
    {
        return $this->belongsTo(MainGroup::class, 'code_main_group');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'code_group');
    }

    public function subGroup()
    {
        return $this->belongsTo(SubGroup::class, 'code_sub_group');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'code_unit');
    }

}
