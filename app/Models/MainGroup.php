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
    protected $guarded = [''];
    protected $primaryKey = 'kode_barang';
    public $incrementing = false; 


    public function getRouteKeyName()
    {
        return 'kode_barang';
    }

    public function group()
    {
        return $this->hasMany(Group::class);
    }

    protected static function newFactory()
    {
        return MainGroupFactory::new();
    }
}
