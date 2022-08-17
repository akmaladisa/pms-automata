<?php

namespace App\Models;

use App\Models\MainGroup;
use Database\Factories\GroupFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    protected $table = 'mst_item_group';
    protected $guarded = [];
    protected $primaryKey = 'code_group';
    public $incrementing = false; 

    public function getRouteKeyName()
    {
        return 'code_group';
    }

    public function mainGroup()
    {
        return $this->belongsTo(MainGroup::class, 'code_main_group');
    }

    public function subGroup()
    {
        return $this->hasMany(SubGroup::class, 'code_group');
    }

    protected static function newFactory()
    {
        return GroupFactory::new();
    }
}
