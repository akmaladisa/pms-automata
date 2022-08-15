<?php

namespace App\Models;

use App\Models\MainGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    protected $table = 'mst_item_group';
    protected $guarded = [''];
    protected $primaryKey = 'code_group';
    public $incrementing = false; 

    public function getRouteKeyName()
    {
        return 'code_group';
    }

    public function maingroup()
    {
        return $this->belongsTo(MainGroup::class, 'code_main_group');
    }
}
