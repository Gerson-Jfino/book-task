<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activitie extends Model
{
    use SoftDeletes;
    public $table = 'activities';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    private static $generated_password;

    protected $hidden=["created_at","updated_at","deleted_at"];

    public $fillable = [
        'name',
        'manager',
        'status_id',
        'owner',
        'start_date',
        'due_date',
        'final_date',
        'status_situation'
    ];
    protected $casts = [
        'name' => 'string',
        'manager' => 'string',
        'status_id' => 'integer',
        'owner' => 'string',
        'status_situation' => 'string'
    ];

    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class, 'status_id');
    }

}
