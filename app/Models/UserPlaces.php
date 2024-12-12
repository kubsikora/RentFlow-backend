<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPlaces extends Model
{
    use SoftDeletes;
    protected $table = 'users_places';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'owner_id', 'resident_id', 'place_id', 'rooms', 'start_living', 'end_living'
    ];

}
