<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $fillable = ['id', 'text', 'idUser', 'idSujet', 'debut', 'reponse'];
}
