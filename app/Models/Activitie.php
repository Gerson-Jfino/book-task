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
        'user_id',
        'owner',
        'start_date',
        'due_date',
        'final_date',
        'status_situation',
        'document',
        'observation',
    ];
    protected $casts = [
        'name' => 'string',
        'manager' => 'string',
        'status_id' => 'integer',
        'user_id' => 'string',
        'owner' => 'string',
        'status_situation' => 'string',
        'document' => 'string',
        'observation' => 'string',
    ];
    public function getDocumentAttribute()
    {
        return $this->attributes['document']?  env('APP_URL') . $this->attributes['document'] : '';
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class, 'status_id');
    }
    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
