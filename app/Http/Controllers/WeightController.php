<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weight;
use App\Http\Requests;

class WeightController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $weights = Weight::all();
        return view('weights.index', compact('weights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('weights.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $weight = Weight::create([
            'weight' => $request['weight'],
            'mouse_id' => $request['mouse_id']
        ]);
        $weight->save();
        return redirect()->action('WeightController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $weight = Weight::find($id);
        return view('weights.show', compact('weight'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $weight = Weight::find($id);
        return view('weights.edit', compact('weight'));
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
        $weight = Weight::find($id);
        $weight->weight = $request['weight'];
        $weight->mouse_id = $request['mouse_id'];
        $weight->save();
        return redirect()->action('WeightController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $weight = Weight::find($id);
        $weight->delete();
        return redirect()->action('WeightController@index');
    }
}
