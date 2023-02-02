<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubMatchs extends Model
{
    use HasFactory;

    protected $table = 'club_matchs';
    protected $guarded = [];

    public function club() {
        return $this->hasMany(Clubs::class);
    }

    public function match() {
        return $this->hasMany(Matchs::class);
    }
}
