<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Places extends Authenticatable
{
    use SoftDeletes;
    
    protected $table = 'places';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'owner_id', 'place_area', 'rooms', 'city', 'zipcode', 'street', 'house_nr', 'flat_nr'
    ];

}
