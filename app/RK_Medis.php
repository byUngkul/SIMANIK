<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RK_Medis extends Model
{
    protected $table = 'rk_medis';
    protected $primariKey = 'id';
     public $incrementing = false;
    protected $fillable = [
    	'id',
		'pasien_id',
		'nama',
		'tgl_lahir',
		'dokter_id',
		'diagnosa',
		'keluhan',
		'anamnesis',
		'tindakan',
		'keterangan',
		'alergi_obat',
		'bb',
		'tb',
		'tensi',
		'bw',
    ];

    public function pasien() {
    	return $this->belongsto('App\Pasien');
    }
}
