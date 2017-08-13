<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Resepsionist extends Authenticatable
{
    use Notifiable;
    
    protected $guard = 'resepsionist';
    
    protected $table = 'resepsionists';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['created_at', 'updated_at'];
    
    protected $fillable = [
             'id',
    	'username',
    	'password',
    	'nama',
    	'alamat',
    	'tgl_lahir',
    	'level',
             'photo',
    ];

    public function getPhoto() {
        if ($this->photo) {
            return $this->photo;
        }
        return null;
    }
    
}
