<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasiens';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
    	'nama',
    	'jenis_kelamin',
    	'telp',
    	'alamat',
    	'tgl_lahir',
    	'pekerjaan',
        'status',
        'layanan_dokter'
    ];
}
