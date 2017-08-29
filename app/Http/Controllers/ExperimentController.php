<?php

namespace App\Http\Controllers;

use App\Experiment;
use Illuminate\Http\Request;
use App\Http\Requests;

class ExperimentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiments = Experiment::all();
        return view('experiments.index', compact('experiments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $experiment = Experiment::create([
            'title' => $request['title'],
            'active' => 1,
        ]);
        $experiment->save();
        return redirect()->action('ExperimentController@index');
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
        $experiment = Experiment::find($id);
        return view('experiments.edit', compact('experiment'));
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
        $experiment = Experiment::find($id);
        $experiment->title = $request['title'];
        $experiment->save();
        return redirect()->action('ExperimentController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $experiment = Experiment::find($id);
        if($experiment->active){
            $experiment->active = false;
        }else{
            $experiment->active = true;
        }
        $experiment->save();
        return redirect()->action('ExperimentController@index');
    }
}
