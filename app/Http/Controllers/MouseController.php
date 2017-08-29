<?php

namespace App\Http\Controllers;

use App\BloodPressure;
use App\Cage;
use App\Colony;
use App\Comment;
use App\Storage;
use App\Surgery;
use App\Tag;
use App\User;
use App\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mouse;
use App\Http\Requests;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;

class MouseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function groupTagged(Request $request){

        $this->validate($request, [
            'group_select_cb' => 'required'
        ]);

        $mice_for_surgery = $request['group_select_cb'];
        $mice = implode(",",$mice_for_surgery);

        if($request['purpose']=="3"){
            $mice = Mouse::whereIn('id', $mice_for_surgery)->get();
            foreach($mice as $mouse) {
                Mouse::where('id', $mouse->id)->update(['is_alive' => false]);
            }
            return redirect()->action('MouseController@index');
        }
        if($request['purpose']=="2" || $request->input('submit') == 'euthanize'){
            return redirect('boxes/'.$mice.'/create/'.$request['storage']);
        }
        if($request['purpose']=="1"){
            return redirect('boxes/'.$mice.'/create/1,1');
        }
        if($request->input('submit') == 'surgery'){
            return redirect('surgeries/'.$mice.'/create');
        }
        if($request->input('submit') == 'edit'){
            if(sizeof($mice_for_surgery)==1){
                return redirect('mice/'.$mice.'/edit');
            }else{
                return redirect('mice/'.$mice.'/bulk_edit');
            }
        }
        return redirect()->action('MouseController@index');

    }

    public function groupUntagged(Request $request){

        //get all active tags
        $mice = Mouse::where('is_alive', 1)->get();
        foreach ($mice as $a_m) {
            if (isset($a_m->tags->last()->tag_num)) {
                $active_tags[] = $a_m->tagPad($a_m->tags->last()->tag_num);
            }
        }
        $new_tags = array_filter($request['new_tag_id']);

        foreach($new_tags as $nt){
            foreach($active_tags as $at){
                if($at == $nt){
                    return Redirect::back()->withErrors(['Tag ' .$at . ' is already active']);
                }
            }
        }

        //determine which action the user wanted to perform
        $action = $request->input('submit');

        //id of all mice in untagged column
        $untagged_mice = $request['mice'];

        //switch to handle the three options from the one form
        switch($action){
            case "remove":
                //id of mice selected for removal
                $mice_to_remove = $request['group_select_untagged_cb'];

                foreach($mice_to_remove as $mouse){
                    Mouse::destroy($mouse);
                }
                return redirect()->action('MouseController@index');
                break;
            case "tag":
                //all values entered to the tag inputs
                $tags = $request['new_tag_id'];
                //remove mice id's that have not returned a value
                for ($x = 0; $x < count($tags); $x++) {
                    if ($tags[$x] == "") {
                        unset($untagged_mice[$x]);
                    }
                }
                //remove empty space from array of tags
                $tags = array_slice(array_filter($tags), 0);

                $mice = Mouse::whereIn('id', $untagged_mice)->get();
                $i = 0;
                foreach($mice as $mouse){
                    $mouse->tags()->attach(($tags[$i]+1));
                    $i++;
                }
                return redirect()->action('MouseController@index');
                break;
            case "sex":
                //mice that have been sexed
                $sexed = $request['sex'];
                $mice = Mouse::whereIn('id', $untagged_mice)->get();

                foreach($mice as $mouse){
                    if(array_key_exists($mouse->id, $sexed)){
                        Mouse::where('id', $mouse->id)->update(array('sex' => $sexed[$mouse->id]));
                    }
                }

                return redirect()->action('MouseController@index');
                break;
        }
    }

    public function index(Request $request)
    {
        $storages = Storage::all();

        if(isset($request['pep_mice'])){
            $mice = Mouse::where('is_alive', 0)->paginate(15);
            $pep = true;
        }else {
            $mice = Mouse::where('is_alive', 1)->get();
            $pep = false;
        }


        foreach ($mice as $a_m) {
            if (isset($a_m->tags->last()->tag_num)) {
                $active_tags[] = $a_m->tagPad($a_m->tags->last()->tag_num);
            }
        }
        if($pep){
            $active_tags[] = 0;
        }

        return view('mice.index', compact('mice', 'active_tags', 'pep', 'storages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
           'select_source'
        ]);

        $mice = Mouse::all();
        $colonies = Colony::all();
        $users = User::all();
        $cage = Cage::find($request['cage_id']);
        $source = $request['source'];

        return view('mice.create', compact('mice', 'colonies', 'users', 'cage', 'source'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mice_total = $request['mice_number'];
        $females = $request['female_mice_number'];

        $source = $request['source'];

        if($source == 'In house') {
            $cage_id = $request['cage_id'];
            $cage = Cage::find($cage_id);
            $father = $cage->male;
            $mother_one = $request['female_parent'];
            $mother_two = null;
            $mother_three = null;
            date_default_timezone_set('America/Edmonton');
            $DOB = new DateTime($request['date_of_birth']);
            $DOB->modify('+3 week');
            $wean_date = $DOB;
            if ($mother_one == '0') {
                $mother_one = $cage->female_one;
                $mother_two = $cage->female_two;
                $mother_three = $cage->female_three;
            }

                for ($i = 0; $i < $mice_total; $i++) {
                    $mouse = Mouse::create([
                        'colony_id' => $request['colony_id'],
                        'source' => $source,
                        'father' => $father,
                        'sex' => null,
                        'mother_one' => $mother_one,
                        'mother_two' => $mother_two,
                        'mother_three' => $mother_three,
                        'birth_date' => $request['date_of_birth'],
                        'wean_date' => $wean_date,
                        'is_alive' => '1',
                    ]);
                    $mouse->save();
                    $user = Auth::user();
                    $comment = Comment::create([
                        'mouse_id' => $mouse->id,
                        'user_id' => $user->id,
                        'comment' => $request['comments']
                    ]);
                    $comment->save();
                }
        }else{
            for($i = 0; $i < $mice_total; $i++) {
                $mouse = Mouse::create([
                    'colony_id' => $request['colony_id'],
                    'source' => $source,
                    'birth_date' => $request['date_received'],
                    'is_alive' => 1,
                    'sick_report' => false,
                ]);
                $mouse->save();
            }

        }


        return redirect()->action('MouseController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mouse = Mouse::find($id);
        $user = User::where('id', $mouse->reserved_for)->get()->first();
        $colony = Colony::find($mouse->colony_id);
        $surgeries = Surgery::with('mice')->get();

        return view('mice.show', compact('mouse', 'user', 'colony', 'surgeries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colonies = Colony::all();
        $editMouse = Mouse::find($id);
        $mice = Mouse::all();
        $users = User::all();

        $active_mice = Mouse::whereDate('end_date', '>=', date('Y-m-d'))->
                                orWhere('end_date', '')->orWhere('end_date', null)->get();

        foreach($active_mice as $a_m){
            if(isset($a_m->tags->last()->tag_num)) {
                $active_tags[] = $editMouse->tagPad($a_m->tags->last()->tag_num);
            }
        }

        return view('mice.edit', compact('editMouse', 'colonies', 'users', 'mice', 'active_tags'));
    }

    public function bulk_edit($mice_id)
    {
        $mice_ex = explode(",", $mice_id);
        $editMice = Mouse::whereIn('id', $mice_ex)->get();
        $colonies = Colony::all();
        $mice = Mouse::all();
        $users = User::all();

        $active_mice = Mouse::whereDate('end_date', '>=', date('Y-m-d'))->
        orWhere('end_date', '')->orWhere('end_date', null)->get();

        foreach($active_mice as $a_m){
            if(isset($a_m->tags->last()->tag_num)) {
                $active_tags[] = $editMice->tagPad($a_m->tags->last()->tag_num);
            }
        }

        return view('mice.edit', compact('editMice', 'colonies', 'users', 'mice', 'active_tags'));
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
        $isSick = 0;
        if($request['sick_report']){
            $isSick = $request['sick_report'];
        }

        if($request['geno'] == 5){
            $geno_a = 1;
            $geno_b = 1;
        }
        elseif($request['geno'] == 3){
            $geno_a = 1;
            $geno_b = 0;
        }elseif($request['geno'] == 1){
            $geno_a = 0;
            $geno_b = 0;
        }else{
            $geno_a = null;
            $geno_b = null;
        }

        $mouse = Mouse::find($id);
        if(!empty($request['reserved_for'])){
            $mouse->reserved_for = $request['reserved_for'];
        }
        if(isset($request['sex'])) {
            $mouse->sex = $request['sex'];
        }
        $mouse->geno_type_a = $geno_a;
        $mouse->geno_type_b = $geno_b;
        $mouse->father = $request['father'];
        $mouse->mother_one = $request['mother_one'];
        if(!empty($request['mother_two'])) {
            $mouse->mother_two = $request['mother_two'];
        }
        if(!empty($request['mother_three'])) {
            $mouse->mother_three = $request['mother_three'];
        }
        $mouse->birth_date = $request['birth_date'];
        if(!empty($request['wean_date'])) {
            $mouse->wean_date = $request['wean_date'];
        }
        if(!empty($request['end_date'])) {
            $mouse->end_date = $request['end_date'];
        }
        $mouse->sick_report = $isSick;
        $mouse->save();

        $user = Auth::user();
        $comment = Comment::create([
            'mouse_id' => $mouse->id,
            'user_id' => $user->id,
            'comment' => $request['comments']
        ]);
        $comment->save();

        if (!empty($request['weight'])) {
            if(isset($mouse->weights->last()->weighed_on)){
                if($mouse->weights->last()->weighed_on != $request['weight_date']) {
                    $weight = Weight::create([
                        'weight' => $request['weight'],
                        'weighed_on' => $request['weight_date'],
                        'mouse_id' => $mouse->id
                    ]);
                    $weight->save();
                }
            }else{
                $weight = Weight::create([
                    'weight' => $request['weight'],
                    'weighed_on' => $request['weight_date'],
                    'mouse_id' => $mouse->id
                ]);
                $weight->save();
            }
        }

        if(!empty($request['bp_date'])){
            if(isset($mouse->blood_pressures->last()->taken_on)) {
                if ($mouse->blood_pressures->last()->taken_on != $request['bp_date']) {
                    $bp = BloodPressure::create([
                        'systolic' => 'null',
                        'diastolic' => 'null',
                        'taken_on' => $request['bp_date'],
                        'mouse_id' => $mouse->id
                    ]);
                    $bp->save();
                }
            }else{
                $bp = BloodPressure::create([
                    'systolic' => 'null',
                    'diastolic' => 'null',
                    'taken_on' => $request['bp_date'],
                    'mouse_id' => $mouse->id
                ]);
                $bp->save();
            }
        }

        if($request['lost_tag_cb'] != 1){
            if(isset($mouse->tags->last()->tag_num)){
                if($request['tag_id'] != $mouse->tagPad($mouse->tags->last()->tag_num)) {
                    $tag_num = $request['tag_id'] + 1;
                    $mouse->tags()->attach($request[$tag_num]);
                }
            }else{
                if(!empty($request['tag_id'])) {
                    $tag_num = $request['tag_id'] + 1;
                    $mouse->tags()->attach($tag_num);
                }
            }
        }

        if(!empty($request['new_tag_id'])){
            $tag_num = $request['new_tag_id'] + 1;
            $mouse->tags()->attach($tag_num);
        }


        return redirect()->action('MouseController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mouse = Mouse::find($id);
        $mouse->delete();
        return redirect()->action('MouseController@index');
    }

    public function excel(){

//        $data = Mouse::get()->toArray();
        //query all required fields
        $mice = Mouse::with('Tags', 'Treatments')->get();


//        return($mice);


        //specify array to set data to.
        $data = [];


        //loop through query and set all key value pairs
        foreach ($mice as $mouse){

            $father = 'N/A';
            $mother_one = 'N/A';
            $mother_two = 'N/A';
            $mother_three = 'N/A';
            $tag = 'N/A';
            if(!is_null($mouse->father_record)){
                $father = $mouse->tagPad($mouse->father_record->tags->last()->tag_num);
            }
            if(!is_null($mouse->mother_one)){
                $mother_one = $mouse->tagPad($mouse->mother_one_record->tags->last()->tag_num);
            }
            if(!is_null($mouse->mother_two)){
                $mother_two = $mouse->tagPad($mouse->mother_two_record->tags->last()->tag_num);
            }
            if(!is_null($mouse->mother_three)){
                $mother_three = $mouse->tagPad($mouse->mother_three_record->tags->last()->tag_num);
            }
            if(isset($mouse->tags->last()->tag_num)){
                $tag = $mouse->tagPad($mouse->tags->last()->tag_num);
            }

            $array = array(
                'ID' => $mouse->id,
                'Tag #' => $tag,
                'Colony' => $mouse->colony->name,
                'Sex' => $mouse->getGender($mouse->sex),
                'Birth Date' => $mouse->birth_date,
                'Wean Date' => $mouse->wean_date,
                'Father Tag#' => $father,
                'Mother One Tag#' => $mother_one,
                'Mother Two Tag#' => $mother_two,
                'Mother Three Tag#' => $mother_three,
                'Alive' => $mouse->is_alive,
                'Sick Report' => $mouse->sick_report,
                'End Date' => $mouse->end_date,
                );



            if(!is_null($mouse->treatments)){
                $i = 1;
                foreach($mouse->treatments as $treatment){
                    $t = 'Treatment ' . $i;
                    $array[$t] = $treatment->title . ': '. $treatment->pivot->dosage . '(kg/mg/day)';
                    $i++;
                }
            }

            array_push($data, $array);
        }


//        return($data);

        return Excel::create('Mouse Data', function($excel) use ($data) {

            $excel->sheet('Info', function($sheet) use ($data)
            {
                $sheet->fromArray($data, null, 'A1', true, true);
            });
        })->download('xlsx');
    }

}