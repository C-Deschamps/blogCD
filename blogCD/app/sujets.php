<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sujets extends Model
{
    protected $fillable = ['id', 'title', 'idUser', 'nbrMessages'];
}
