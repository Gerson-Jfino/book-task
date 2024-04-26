<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    //
    public $table = 'incidents';



    public $fillable = [
        'id',
        'start',
        'end',
        'incident',
        'description',
        'resolution',
    ];
}

