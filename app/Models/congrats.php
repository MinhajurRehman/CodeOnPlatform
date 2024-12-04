<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class congrats extends Model
{
    use HasFactory;

    protected $table = 'congratulations';
    protected $primarykey = 'id';
}