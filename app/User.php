<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\HasActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Auth\User as MonogoAuthenticatable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes as MongoSoftDeletes;
use DesignMyNight\Mongodb\Auth\User as MonogoPassportAuthenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, Notifiable, HasActivity, HasMediaTrait, SoftDeletes;

    // protected $connection = 'mongodb';
    // protected $collection = 'users';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        //
    ];
    protected $touches = [
        //
    ];
    public $incrementing = true;
    public $timestamps = true;

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [
        //
    ];
    protected static $logOnlyDirty = false;
    protected static $logName = 'user';

    public function socials()
    {
        return $this->hasMany('App\UserSocial', 'user_id');
    }

    public function social()
    {
        return $this->hasOne('App\UserSocial', 'user_id');
    }
}
