<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class open extends Model
{
    use HasFactory;

    protected $table = 'openchallenges';

    protected $fillable = [
        'creator_id',
        'joiner_id',
        'language',
    ];

}