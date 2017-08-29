<?php

namespace App\Http\Controllers;

use App\Colony;
use App\Storage;
use App\Tissue;
use App\Treatment;
use App\Experiment;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AppManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiments = Experiment::where('active', 1)->get();
        $treatments = Treatment::where('active', 1)->get();
        $tissues = Tissue::where('active', 1)->get();
        $colonies = Colony::with('mice')->get();
        $users = User::all();
        $freezers = Storage::where('type', 1)->get();
        $histologies = Storage::where('type', 0)->get();

        $total_rows = max(count($experiments), count($treatments), count($tissues));

        return view('appManagement.index',
            compact('users', 'colonies', 'tissues', 'treatments', 'experiments', 'total_rows', 'freezers', 'histologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appManagement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
