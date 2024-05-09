<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    //
    public $table = 'incidents';



    public $fillable = [
        'id',
        'user_id',
        'start',
        'end',
        'incident',
        'description',
        'resolution',
    ];
    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}

