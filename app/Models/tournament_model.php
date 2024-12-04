<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tournament_model extends Model
{
    protected $table = 'tournaments';
    protected $primarykey = 'id';

    use HasFactory;

    public function organizer() {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function patricipants() {
        return $this->hasMany(participant::class, "tournament_id");
    }
}