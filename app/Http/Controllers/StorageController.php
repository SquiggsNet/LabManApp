<?php

namespace App\Http\Controllers;
use App\Box;
use App\Compartment;
use App\Mouse;
use App\MouseStorage;
use App\Shelf;
use App\Storage;
use Illuminate\Http\Request;

use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;

class StorageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $storages = Storage::all()->groupBy('type');
        $histologies = $storages[0];
        $freezers = $storages[1];
        return view('storages.index', compact('histologies', 'freezers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($mice_id)
    {


        return view('storages.create', compact('mice', 'tissues', 'boxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storage = Storage::create([
            'tissue_id' => $request['tissue_id'],
            'type' => $request['type'],
            'freezer' => $request['freezer'],
            'compartment' => $request['compartment'],
            'shelf' => $request['shelf']
        ]);
        $storage->save();
        return redirect()->action('StorageController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $storage = Storage::find($id);
        return view('storages.show', compact('storage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $storage = Storage::find($id);
        return view('storages.edit', compact('storage'));
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
        $storage = Storage::find($id);
        $storage->tissue_id = $request['tissue_id'];
        $storage->type = $request['type'];
        $storage->freezer = $request['freezer'];
        $storage->compartment = $request['compartment'];
        $storage->shelf = $request['shelf'];
        $storage->save();
        return redirect()->action('StorageController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storage = Storage::find($id);
        $storage->delete();
        return redirect()->action('StorageController@index');
    }

    public function excel(){

        $storages = MouseStorage::with('mouse', 'box', 'tissue', 'user')->get();

        //specify array to set data to.
        $data = [];

        //loop through query and set all key value pairs
        foreach ($storages as $storage){

            $shelf = Shelf::find($storage->box->shelf_id);
            $compartment = Compartment::find($shelf->compartment_id);
            $storage_type = Storage::find($compartment->storage_id);

            $father = 'N/A';
            $mother_one = 'N/A';
            $mother_two = 'N/A';
            $mother_three = 'N/A';
            $tag = 'N/A';
            if(!is_null($storage->mouse->father_record)){
                $father = $storage->mouse->tagPad($storage->mouse->father_record->tags->last()->tag_num);
            }
            if(!is_null($storage->mouse->mother_one)){
                $mother_one = $storage->mouse->tagPad($storage->mouse->mother_one_record->tags->last()->tag_num);
            }
            if(!is_null($storage->mouse->mother_two)){
                $mother_two = $storage->mouse->tagPad($storage->mouse->mother_two_record->tags->last()->tag_num);
            }
            if(!is_null($storage->mouse->mother_three)){
                $mother_three = $storage->mouse->tagPad($storage->mouse->mother_three_record->tags->last()->tag_num);
            }
            if(isset($storage->mouse->tags->last()->tag_num)){
                $tag = $storage->mouse->tagPad($storage->mouse->tags->last()->tag_num);
            }
            if($storage->mouse->sick_report){
                $sr = 'True';
            }else{
                $sr = 'False';
            }
            if($storage_type->type == 1){
                $store = 'Freezer';
                $comp = $compartment->description;
                $sh = $shelf->description;
            }else{
                $store = 'Histology';
                $comp = 'N/A';
                $sh = 'N/A';
            }

            $array = array(
                'Extraction Date' => $storage->extraction_date,
                'Extracted By' => $storage->mouse->getUserName($storage->user_id),
                'Box' => $storage->box->column . '-' . $storage->box->row . '-' . $storage->box->box,
                'Location' => $store,
                'Compartment' => $comp,
                'Shelf' => $sh,
                'Mouse Tag #' => $tag,
                'Colony' => $storage->mouse->colony->name,
                'Sex' => $storage->mouse->getGender($storage->mouse->sex),
                'Birth Date' => $storage->mouse->birth_date,
                'Wean Date' => $storage->mouse->wean_date,
                'Father Tag#' => $father,
                'Mother One Tag#' => $mother_one,
                'Mother Two Tag#' => $mother_two,
                'Mother Three Tag#' => $mother_three,
                'Sick Report' => $sr,
                'End Date' => $storage->mouse->end_date,
                'Tissue' => $storage->tissue->name
            );

            if(!is_null($storage->mouse->treatments)){
                $i = 1;
                foreach($storage->mouse->treatments as $treatment){
                    $t = 'Treatment ' . $i;
                    $array[$t] = $treatment->title . ': '. $treatment->pivot->dosage . '(kg/mg/day)';
                    $i++;
                }
            }

            array_push($data, $array);
        }

        return Excel::create('Storage Data', function($excel) use ($data) {

            $excel->sheet('Info', function($sheet) use ($data)
            {
                $sheet->fromArray($data, null, 'A1', true, true);
            });
        })->download('xlsx');
    }
}
