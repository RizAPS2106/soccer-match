<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchs extends Model
{
    use HasFactory;

    protected $table = 'matchs';
    protected $guarded = [];

    public function clubMatch()
    {
        return $this->belongsTo(ClubMatchs::class);
    }
}
