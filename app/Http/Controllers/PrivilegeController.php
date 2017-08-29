<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Privilege;
use App\Http\Requests;

class PrivilegeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //talk to model
        $privileges = Privilege::all();
        //pick view to display
        return view('privileges.index', compact('privileges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('privileges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //talk to model
        $privilege = Privilege::create([
            'name' => $request['name'],
        ]);
        $privilege->save();
        return redirect()->action('PrivilegeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //talk to model
        $privilege = Privilege::find($id);
        //pick view to display
        return view('privileges.show', compact('privilege'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $privilege = Privilege::find($id);
        return view('privileges.edit', compact('privilege'));
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
        $privilege = Privilege::find($id);
        $privilege->name = $request['name'];
        $privilege->save();
        return redirect()->action('PrivilegeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $privilege = Privilege::find($id);
        $privilege->delete();
        return redirect()->action('PrivilegeController@index');
    }
}
