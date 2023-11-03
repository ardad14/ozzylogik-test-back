<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $collection = 'users';
    protected $primaryKey = '_id';

    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'password',
        'role',
    ];
}
