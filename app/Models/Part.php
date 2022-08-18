<?php

namespace App\Models;

use Database\Factories\PartFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Part extends Model
{
    use HasFactory;
    protected $table = 'mst_item_part';
    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = 'code_part';

    public function getRouteKeyName()
    {
        return 'code_part';
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

    public function component()
    {
        return $this->belongsTo(Component::class, 'code_component');
    }

    protected static function newFactory()
    {
        return PartFactory::new();
    }
}
