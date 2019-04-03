<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class scores extends Model
{
   protected $fillable = ['id', 'idQuizz', 'idUser', 'score', 'numTentative'];

}
