<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // permitir que se puedan guardar datos en el campo correspondiente
    protected $fillable = ['keep'];
}
