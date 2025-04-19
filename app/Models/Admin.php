<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use Notifiable;
    //Which fileds are going to filed on the login form 
    protected $fillable = [
         'email', 'password',
    ];
    //Hidden Fields (Password) for protecting your admin's data
    protected $hidden = [
        'password', 'remember_token',
    ];
    //Admin Model
    protected $table = "users";
}