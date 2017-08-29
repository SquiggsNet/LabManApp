<?php

namespace App\Http\Controllers;

use App\Cage;
use App\Mouse;
use App\Tag;
use Illuminate\Http\Request;
use App\Colony;
use App\Http\Requests;

class ColonyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mice = Mouse::all();
        $colonies = Colony::all();
        $cages = Cage::all();

        return view('colonies.index', compact('mice', 'colonies', 'cages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colonies = Colony::with('mice')->get();
        return view('colonies.create', compact('colonies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $colony = Colony::create([
            'name' => $request['name'],
            'active' =>true
        ]);
        $colony->save();
        return redirect()->action('ColonyController@create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $colony = Colony::with('mice.tags')->find($id);

        foreach ($colony->mice as $a_m) {
            if (isset($a_m->tags->last()->tag_num)) {
                $active_tags[] = $a_m->tagPad($a_m->tags->last()->tag_num);
            }
        }
        return view('colonies.show', compact('colony', 'active_tags', 'mice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colony = Colony::find($id);
        return view('colonies.edit', compact('colony'));
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
        $colony = Colony::find($id);
        $colony->name = $request['name'];
        $colony->save();
        return redirect()->action('ColonyController@create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $colony = Colony::find($id);
        if($colony->active){
            $colony->active = false;
        }else{
            $colony->active = true;
        }
        $colony->save();
        return redirect()->action('ColonyController@create');
    }
}
