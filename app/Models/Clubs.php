<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clubs extends Model
{
    use HasFactory;

    protected $table = 'clubs';
    protected $guarded = [];

    public function clubMatch()
    {
        return $this->belongsTo(ClubMatchs::class);
    }
}
