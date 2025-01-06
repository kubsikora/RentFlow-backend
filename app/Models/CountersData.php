<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CountersData extends Model
{
    protected $table = 'counters_data';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'counter_id', 'place_id', 'value', 'updated_at', 'created_at'
    ];
}
