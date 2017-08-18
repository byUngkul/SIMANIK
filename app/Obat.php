<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obats';

    protected $fillable = [
    	'nama',
	'kandungan',
	'kategori_id',
	'harga',
	'status',
    ];

    public function kategori() {
    	return $this->belongsTo('App\KategoriObat');
    }

    // public function resep() {
    //     return $this->hasMany('App\Resep')->sum('harga');
    // }
}
