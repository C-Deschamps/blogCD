<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
     protected $fillable = ['id', 'name', 'idUser', 'nbrQuestion'];
}
