<?php

namespace App\Http\Controllers;

use App\Mouse;
use App\Storage;
use App\Treatment;
use App\Experiment;
use App\User;
use Illuminate\Http\Request;
use App\Surgery;
use Illuminate\Pagination\Paginator;

class SurgeryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $storages = Storage::all();
        $surgeries = Surgery::with('user', 'mice')->get();
        return view('surgeries.index', compact('surgeries', 'user', 'mice', 'storages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $mice_id
     * @return \Illuminate\Http\Response
     * @internal param $mice
     * @internal param Request $request
     */
    public function create($mice_id)
    {
        $mice_ex = explode(",", $mice_id);
        $mice = Mouse::whereIn('id', $mice_ex)->get();
        $surgeons = User::all();
        $treatments = Treatment::all();
        $experiments = Experiment::all();

        $t_rows = count($mice) * count($treatments);

        return view('surgeries.create', compact('mice', 'surgeons', 'treatments', 'experiments', 't_rows'));
    }

    /**
     * @param Request $request
     * @param $surgery
     * @return string
     * @internal param $mouse_id
     * @internal param $mouse
     */
    public function remove(Request $request, $surgery){
        $mouse = Mouse::find($request['mouse']);
        $treatments = Treatment::all();
        $surgery = Surgery::find($surgery);
        $surgery->mice()->detach($mouse->id);
        $mouse->treatments()->detach($treatments);
        return redirect()->action('SurgeryController@index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get all mice selected for surgery
        $mice = Mouse::whereIn('id', $request['surgery_mice'])->get();

        //create the surgery
        $surgery = Surgery::create([
            'user_id' => $request['surgeon'],
            'title' => $request['surgery_title'],
            'scheduled_date' => $request['scheduled_date'],
            'end_date' => $request['end_date'],
        ]);
        $surgery->save();

        $mouse_list = 0;
        foreach($mice as $mouse){
            //set the reserved for of each mouse
            $reserved_for = $request[$mouse_list .'_user'];
            Mouse::where('id', $mouse->id)->update(['reserved_for' => $reserved_for[0]]);

            //attach the mice to the newly created surgery
            $surgery->mice()->attach($mouse->id);

            //get treatments, experimental use and dosage associated with each mouse
            $treatments = $request[$mouse_list .'_treatment'];
            $dosage = $request[$mouse_list . '_dosage'];
            $experiment = $request[$mouse_list . '_experiment'];

            //attach the mice to the treatment type and add the dosage into the pivot table
            for($i = 0; $i < count($treatments); $i++){
                if($treatments[$i] != 0){

                    $mouse->treatments()->attach($treatments[$i], ['dosage' => $dosage[$i]]);
                }

            }
            //attach the mice to the experiment type
            $mouse->experiments()->attach($experiment);
        //increment to the next row
        $mouse_list++;
        }
        return redirect()->action('SurgeryController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $surgery = Surgery::with('user', 'mice')->find($id);
        $surgeons = User::all();
        $treatments = Treatment::all();
        $experiments = Experiment::all();
        return view('surgeries.show', compact('surgery', 'user', 'mice', 'treatments', 'experiments', 'surgeons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $surgery = Surgery::with('user', 'mice')->find($id);
        $surgeons = User::all();
        $treatments = Treatment::all();
        $experiments = Experiment::all();
        return view('surgeries.edit', compact('surgery', 'user', 'mice', 'surgeons', 'treatments', 'experiments'));
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
        $surgery = Surgery::find($id);
        $mouse_list = 0;

        $surgery->update([
            'user_id' => $request['surgeon'],
            'title' => $request['surgery_title'],
            'scheduled_date' => $request['scheduled_date'],
            'end_date' => $request['end_date'],
        ]);

        foreach($surgery->mice as $mouse){
            //set the reserved for of each mouse
            $reserved_for = $request[$mouse_list .'_user'];
            Mouse::where('id', $mouse->id)->update(['reserved_for' => $reserved_for[0]]);

            //get treatments, experimental use and dosage associated with each mouse
            $treatments = $request[$mouse_list .'_treatment'];

            $dosage = $request[$mouse_list . '_dosage'];
            $experiment = $request[$mouse_list . '_experiment'];

            //attach the mice to the treatment type and add the dosage into the pivot table
            for($i = 0; $i < count($treatments); $i++){
                if($treatments[$i] != 0){
                    $mouse->treatments()->syncWithoutDetaching(array($treatments[$i] => array('dosage' => $dosage[$i])));
                }
            }
            //attach the mice to the experiment type
            $mouse->experiments()->sync( (array) $experiment);
            //increment to the next row
            $mouse_list++;
        }
        return redirect()->action('SurgeryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get the surgery
        $surgery = Surgery::find($id);

        //get mice associated with the surgery
        $mice = $surgery->mice()->where('surgery_id', $surgery->id)->get();

        foreach($mice as $mouse){

            //get all treatments associated with each mouse
            $treatments = $mouse->treatments()->where('mouse_id', $mouse->id)->get();

            //detach treatments
            $mouse->treatments()->detach($treatments);

            //get experimental uses associated with each mouse
            $experiment = $mouse->experiments()->where('mouse_id', $mouse->id)->get();

            //detach experiments
            $mouse->experiments()->detach($experiment);

            //detach mice from surgery
            $surgery->mice()->detach($mouse);
        }
        //delete the surgery
        $surgery->delete();

        return redirect()->action('SurgeryController@index');
    }
}
