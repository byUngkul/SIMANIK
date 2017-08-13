<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Apoteker extends Authenticatable
{
    use Notifiable;

    protected $guard = 'apoteker';
    protected $table = 'apotekers';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
             'id',
    	'username',
    	'password',
    	'nama',
    	'alamat',
    	'tgl_lahir',
    	'level',
             'photo'
    ];

    public function getPhoto() {
        return $this->photo;
    }
}
