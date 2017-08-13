<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resep;

class ApotekerController extends Controller
{
    public function __construct() {
    	  $this->middleware('apoteker');
    }

    public function index() {
    	$resep = Resep::whereDate('created_at', date('Y-m-d'))->get()->toArray();
    	return view('apoteker.index', ['resep' => $resep]);
    }

    public function getObat() {
    	return view('apoteker.obat');
    }

}
