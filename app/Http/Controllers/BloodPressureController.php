<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BloodPressure;
use App\Http\Requests;

class BloodPressureController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bloodPressures = BloodPressure::all();
        return view('bloodPressures.index', compact('bloodPressures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bloodPressures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bloodPressure = BloodPressure::create([
            'systolic' => $request['systolic'],
            'diastolic' => $request['diastolic'],
            'mouse_id' => $request['mouse_id']
        ]);
        $bloodPressure->save();
        return redirect()->action('BloodPressureController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bloodPressure = BloodPressure::find($id);
        return view('bloodPressures.show', compact('bloodPressure'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bloodPressure = BloodPressure::find($id);
        return view('bloodPressures.edit', compact('bloodPressure'));
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
        $bloodPressure = BloodPressure::find($id);
        $bloodPressure->systolic = $request['systolic'];
        $bloodPressure->diastolic = $request['diastolic'];
        $bloodPressure->mouse_id = $request['mouse_id'];
        $bloodPressure->save();
        return redirect()->action('BloodPressureController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bloodPressure = BloodPressure::find($id);
        $bloodPressure->delete();
        return redirect()->action('BloodPressureController@index');
    }
}
