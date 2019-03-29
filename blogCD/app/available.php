<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class available extends Model
{
    protected $fillable = ['id', 'idQuizz', 'idUser', 'available'];
}
