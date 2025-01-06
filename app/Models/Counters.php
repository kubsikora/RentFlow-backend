<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Counters extends Model
{
    protected $table = 'counters';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'name', 'type', 'operator', 'unit'
    ];
}
