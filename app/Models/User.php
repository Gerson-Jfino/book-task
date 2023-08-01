<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Str;

class User extends Authenticatable implements JWTSubject
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
        'login_attempts'
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
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function role() {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }
}
