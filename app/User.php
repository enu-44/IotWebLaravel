<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'last_name',
        'phone',
        'address',
        'path',
        'fecha_registro',
        'identification',
        'email', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function HasManyProjects(){
        return $this->hasMany('App\Proyectos.php');
    }


/*
    public function propietarioRol(){

        return $this->belongsTo('App\Roles');
    }

     public function propietarioTypeIdentification(){

        return $this->belongsTo('App\TypeIdentification');
    }


    public function HasManyLocation(){
        return $this->hasMany('App\LocationResidencesUsers.php');
    }

    public function HasManyNotifications(){
        return $this->hasMany('App\Notifications.php');
    }


    public function HasManyRequestCointTable(){
        return $this->hasMany('App\RequestCoinTables.php');
    }*/

    



}
