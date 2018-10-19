<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as MongoModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes as MongoSoftDeletes;

class ExampleModel extends Model
{
    use LogsActivity, SoftDeletes;

    // protected $connection = 'mongodb';
    // protected $collection = 'example';
    protected $table = 'example';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = [];
    protected $hidden = [
        //
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
    protected static $logName = 'example';
}
