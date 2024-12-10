<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{

    use SoftDeletes;
    protected $table = 'users';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'login', 'hash_password', 'name', 'surname', 'email', 'tel', 'flat_owner', 'birthday'
    ];

    protected $hidden = [
        'hash_password'
    ];
}
