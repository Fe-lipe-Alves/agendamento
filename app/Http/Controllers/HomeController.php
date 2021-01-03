<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Carbon::now();
        return view('pages.home', compact('data'));
    }
}
