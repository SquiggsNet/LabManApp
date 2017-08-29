<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tissue;
use App\Http\Requests;

class TissueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tissues = Tissue::all();
        return view('tissues.index', compact('tissues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tissues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tissue = Tissue::create([
            'name' => $request['name'],
            'active' => true
        ]);
        $tissue->save();
        return redirect()->action('TissueController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tissue = Tissue::find($id);
        return view('tissues.show', compact('tissue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tissue = Tissue::find($id);
        return view('tissues.edit', compact('tissue'));
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
        $tissue = Tissue::find($id);
        $tissue->name = $request['name'];
        $tissue->save();
        return redirect()->action('TissueController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tissue = Tissue::find($id);
        if($tissue->active){
            $tissue->active = false;
        }else{
            $tissue->active = true;
        }
        $tissue->save();
        return redirect()->action('TissueController@index');
    }
}
