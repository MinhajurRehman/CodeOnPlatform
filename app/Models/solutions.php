<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solutions extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primarykey = 'id';
}
