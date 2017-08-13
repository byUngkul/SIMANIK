<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilPeriksa extends Model
{
    protected $table = 'hasil_periksas';

    protected $fillable = [
    	'rk_medis_id',
    	'diagnosa',
    	'tindakan',
    	'resep_id',
    ];	
}

