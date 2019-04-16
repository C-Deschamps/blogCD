<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Possibilites extends Model
{
    protected $fillable = ['id', 'type', 'idQuizz', 'title', 'reponse', 'isRight', 'NumQuestion', 'picture', 'description'];
}
