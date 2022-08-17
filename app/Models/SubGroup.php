<?php

namespace App\Models;

use Database\Factories\SubGroupFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubGroup extends Model
{
    use HasFactory;

    protected $table = 'mst_item_sub_group';
    protected $guarded = [];
    protected $primaryKey = 'code_sub_group';
    public $incrementing = false; 

    public function getRouteKeyName()
    {
        return 'code_sub_group';
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
        return SubGroupFactory::new();
    }
}
