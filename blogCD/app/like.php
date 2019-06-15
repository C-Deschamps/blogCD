<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    protected $fillable = ['id', 'idSujet', 'idUser', 'idComment', 'idQuizz'];
}
