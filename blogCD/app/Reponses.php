<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponses extends Model
{
   protected $fillable = ['id', 'numQuestion', 'idQuizz', 'idUser', 'idPossibilites', 'reponseSimple', 'isRight', 'numTentative'];
}
