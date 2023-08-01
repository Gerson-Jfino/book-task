<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    private static $generated_password;

    protected $hidden=["created_at","updated_at","deleted_at","password"];

    public $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'active',
        'password',
        'first_login',
        'remember_token'
    ];
    protected $casts = [
        'id' => 'string',
        'role_id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'active' => 'boolean',
        'remember_token' => 'string'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->id = (string)Str::uuid();
        });
    }
    public static $rules = [
        'role_id' => 'required',
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'
    ];
}
