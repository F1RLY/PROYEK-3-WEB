<?php

namespace App\Models;

// use Illuminate\Foundation\Auth\Users as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Users extends Model
{
    use Notifiable;

    protected $table = "users";
    protected $primaryKey = "id";
    protected $fillable = ['username','kode', 'email', 'password', 'role','foto'];

    protected $hidden = ['password', 'remember_token'];
}
