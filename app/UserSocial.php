<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as MongoModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes as MongoSoftDeletes;

class UserSocial extends Model
{
    use LogsActivity, SoftDeletes;

    // protected $connection = 'mongodb';
    // protected $collection = 'user_socials';
    protected $table = 'user_socials';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = [];
    protected $hidden = [
        'token', 'socialite',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'token_expiry',
    ];
    protected $casts = [
        'socialite' => 'object',
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
    protected static $logName = 'social';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function scopeSocial($query, string $socialType)
    {
        return $query->where('social_type', $socialType);
    }

    public function scopeSocialId($query, string $socialId)
    {
        return $query->where('social_id', $socialId);
    }
}
