<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes as MongoSoftDeletes;

class ExampleMongoModel extends MongoModel
{
    use MongoSoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'example';
    protected $guarded = [];
    protected $hidden = [
        //
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
}
