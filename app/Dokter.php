<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dokter extends Authenticatable
{
   use Notifiable;

   protected $guard = 'dokter';
   protected $primaryKey = 'id';
   public $incrementing = false;
   protected $table = 'dokters';
   protected $fillable = [
         'id',
   	'username',
   	'password',
   	'nama',
   	'alamat',
   	'tgl_lahir',
   	'spesialis_id',
          'level',
          'photo'

   ];

   public function spesialis() {
      return $this->belongsTo('App\Speasialis');
   }

   public function getPhoto() {
      return $this->photo;
   }

   
}
