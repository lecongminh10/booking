<?php

namespace App\Modules\Auth\Infra\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected static function newFactory()
    {
        return \App\Modules\Auth\Database\Factories\UserFactory::new();
    }
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
