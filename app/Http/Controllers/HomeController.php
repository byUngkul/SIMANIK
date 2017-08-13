<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
        dd('admin');
        return $this->middleware('auth');
    }

    public function index() {
        return 'user';
    }
}
