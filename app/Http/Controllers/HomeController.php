<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Colony;
use App\Storage;
use App\Surgery;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $colonies = Colony::all();
        $storages = Storage::all()->groupBy('type');
        $histologies = $storages[0];
        $freezers = $storages[1];
        $surgeries = Surgery::all();

        return view('home', compact('colonies', 'surgeries', 'histologies', 'freezers'));
    }
}
