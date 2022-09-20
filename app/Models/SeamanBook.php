<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeamanBook extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'seaman_books';

    public function crew()
    {
        return $this->belongsTo(Crew::class, 'id_crew');
    }
}
