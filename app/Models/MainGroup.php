<?php

namespace App\Models;

use App\Models\Group;
use Database\Factories\MainGroupFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainGroup extends Model
{
    use HasFactory;
    protected $table = 'mst_item_main_group';
    protected $guarded = [];
    protected $primaryKey = 'code_main_group';
    public $incrementing = false; 


    public function getRouteKeyName()
    {
        return 'code_main_group';
    }

    public function group()
    {
        return $this->hasMany(Group::class, 'code_main_group');
    }

    public function subGroup()
    {
        return $this->hasMany(SubGroup::class, 'code_main_group');
    }

    protected static function newFactory()
    {
        return MainGroupFactory::new();
    }
}
