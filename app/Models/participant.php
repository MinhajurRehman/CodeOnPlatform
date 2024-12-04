<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class participant extends Model
{
    use HasFactory;
    protected $table = 'tournaments_participants';
    protected $primarykey = 'id';

    function tournament(){
        $this->belongsTo(tournament_model::class, "tournament_id");
    }

    function participant(){
        return $this->belongsTo(User::class, 'participant_id');
    }
}