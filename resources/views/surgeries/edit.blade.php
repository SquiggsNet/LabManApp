@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            <label class="control-label">Edit Surgery: {{ $surgery->title }}</label>
        </h1>
        <form role="form" method="POST" action="/surgeries/{{ $surgery->id }}">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="PUT" />
        <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
            <thead>
            <tr>
                <th data-field="tag" >Tag</th>
                <th>Strain</th>
                <th>Geno Type</th>
                <th>Age</th>
                <th>Weight</th>
                <th>Treatment</th>
                <th>Dosage(mg/kg/day)</th>
                <th>Experimental Use</th>
                <th>End User</th>
            </tr>
            </thead>
            <tbody>
            <?php $m_num = 0;?>
            @foreach ($surgery->mice as $mouse)
                @if(isset($mouse->tags->last()->tag_num))
                    @if($mouse->sex == 'True')
                        <?php $class = "info" ?>
                    @else
                        <?php $class = "danger" ?>
                    @endif
                    @if($mouse->sick_report)
                        <?php $id = "report" ?>
                    @else
                        <?php $id = "no_report" ?>
                    @endif
                    <tr class="{{ $class }}" id="{{ $id }}">
                        {{--Mouse Tags--}}
                        <td>
                            <a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">
                                {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}
                            </a>
                        </td>
                        {{--Strain--}}
                        <td>
                            <a href="{{ action( 'ColonyController@show', ['id' => $mouse->colony->id]) }}">
                                {{$mouse->colony->name}}
                            </a>
                        </td>
                        {{--GenoType--}}
                        <td>
                            @if(isset($mouse->geno_type_a))
                                {{ $mouse->genoFormat($mouse->geno_type_a, $mouse->geno_type_b) }}
                            @else
                                N/A
                            @endif
                        </td>
                        {{--Age--}}
                        <td>
                            {{$mouse->getAge($mouse->birth_date)}}
                        </td>
                        {{--Current Weight--}}
                        <td>
                            @if(isset($mouse->weights->last()->weight))
                                {{$mouse->weights->last()->weight}}g
                            @endif
                        </td>
                        {{--Treatment--}}
                        <td class="col-lg-2">
                            <input type="hidden" id="{{$m_num}}_viewable" value="1"/>
                            @for($i = 0; $i < count($treatments); $i++)
                                <select name="{{ $m_num }}_treatment[]" id="treatment" class="form-control">
                                    <option value="0">Treatment Type</option>
                                    @foreach($treatments as $treatment)
                                        <option value="{{ $treatment->id }}"
                                        @foreach($mouse->treatments as $index => $treat)
                                            @if($i == $index and $treat->id == $treatment->id)
                                                {{ "selected='selected'" }}
                                            @endif
                                        @endforeach
                                        >
                                            {{ $treatment->title }}
                                        </option>
                                    @endforeach
                                </select>
                            @endfor
                            <button id="{{$m_num}}_add" value="{{ $m_num }}" type="button"
                                    onclick="addTreatment({{ $m_num }})" class="pull-left" >
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                            <button id="{{$m_num}}_remove" value="{{ $m_num }}" type="button"
                                    onclick="removeTreatment({{ $m_num }})" class="pull-left" hidden>
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </td>
                        {{--Dosage--}}
                        <td class="col-lg-1">
                            @for($i = 0; $i < count($treatments); $i++)
                                <input class="form-control" name="{{ $m_num }}_dosage[]" id="dosage" type="number" step="any"
                                @foreach($mouse->treatments as $index => $treat)
                                    @if($i == $index)
                                        value="{{$treat->pivot->dosage}}"
                                    @endif
                                @endforeach
                                />
                            @endfor
                        </td>
                        {{--Experimental Use--}}
                        <td class="col-lg-2">
                            <select name="{{ $m_num }}_experiment[]" id="experiment" class="form-control">
                                <option value="0">Experiment Type</option>
                                @foreach($experiments as $experiment)
                                    <option value="{{ $experiment->id }}"
                                    @if($experiment->id == $mouse->experiments->last()->id)
                                        {{ "selected='selected'" }}
                                            @endif>
                                        {{ $experiment->title }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        {{--End User--}}
                        <td>
                            <select name="{{ $m_num }}_user[]" id="user" class="form-control">
                                <option value="0">End User</option>
                                @foreach($surgeons as $surgeon)
                                    <option value="{{ $surgeon->id }}"
                                    @if($surgeon->id == $mouse->reserved_for)
                                        {{ "selected='selected'" }}
                                            @endif>
                                        {{ $surgeon->getFullName($surgeon->id) }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <?php $m_num++; ?>
                @endif
            @endforeach
            </tbody>
        </table>
        @foreach ($surgery->mice as $mouse)
            <input type="hidden" name="surgery_mice[]" value="{{$mouse->id}}"/>
        @endforeach
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6">
                                <div class="form-group col-md-12">
                                    <label class="form-label" >Short Description</label>
                                    <input class="form-control" id="surgery_title" name="surgery_title" type="text" value="{{ $surgery->title }}"/>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label" >Surgeon</label>
                                    <select name="surgeon" id="surgeon" class="form-control">
                                        <option value="0">Select Surgeon...</option>
                                        @foreach($surgeons as $surgeon)
                                            <option value="{{ $surgeon->id }}"
                                            @if($surgeon->id == $surgery->user->id)
                                                {{ "selected='selected'" }}
                                            @endif>
                                                {{$surgeon->first_name . ' ' . $surgeon->last_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <div class="form-group col-md-12">
                                    <label class="form-label" >Scheduled Surgery Date</label>
                                    <input class="form-control" placeholder="Surgery Date" id="date" name="scheduled_date" type="date" value="{{ $surgery->scheduled_date }}"/>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label" >Planned End Date</label>
                                    <input class="form-control" placeholder="End Date" id="date" name="end_date" type="date" value="{{ $surgery->end_date }}"/>
                                </div>
                                <div class="col-md-12" style="height:20px;"></div>
                                <div class="form-group col-md-12 hidden-xs">
                                    {!! Form::submit('Save',['class'=>'btn btn-default pull-right']) !!}
                                </div>
                                <div class="form-group col-md-12 hidden-sm hidden-md hidden-lg">
                                    {!! Form::submit('Save',['class'=>'btn btn-default pull-right']) !!}
                                </div>
                            </div>
                        </div>
                    <a class="pull-right" href="{{ action( 'SurgeryController@index') }}">
                        Go Back
                    </a>
                </div>
            </div>
        </div>
        </form>
    </div>

    <script type="text/javascript">
        //get the total amount of mice rows
        var rows = "{{ count($surgery->mice)}}"
        //total amount of treatments available
        var treatments = "{{ count($treatments) }}"
        //empty array to load data too=
        var ddl_treatment = [];
        var ddl_experiment = [];
        var dosage = [];

        //populate the nested array with all the treatments per mouse
        for(var i = 0; i < rows; i++){
            for(var j = 0; j < treatments; j++) {
                ddl_treatment[i] = document.getElementsByName(i + '_treatment[]');
                ddl_experiment[i] = document.getElementsByName(i + '_experiment[]');
                dosage[i] = document.getElementsByName(i + '_dosage[]');
            }
        }

        //hide all treatments that are beyond the first one.
        for(var x = 0; x < ddl_treatment.length; x++){
            var ddl = ddl_treatment[x];
            var dose = dosage[x];
            for(var y = 0; y < ddl.length; y++) {
                if(y != 0){
                    ddl[y].style.display = 'none';
                    dose[y].style.display = 'none';
                    //alert("Dose: " + dose[y].value);
                }
                if(dose[y].value != "")
                {
                    ddl[y].style.display = 'block';
                    dose[y].style.display = 'block';
                }
            }
        }

        //button clicked to add a treatment during create surgery
        function addTreatment(btn_pressed){
            var ddl_treatment = [];
            var dosage = [];
            var viewable = [];

            //populate the nested array with all the treatments per mouse
            for(var i = 0; i < rows; i++){
                //get the hidden element to determine how many rows are visible
                viewable[i] = $('#'+ i + '_viewable').val();
                for(var j = 0; j < treatments; j++) {
                    ddl_treatment[i] = document.getElementsByName(i + '_treatment[]');
                    dosage[i] = document.getElementsByName(i + '_dosage[]');
                }
            }

            //hide all treatments that are beyond the first one.
            for(var x = 0; x < ddl_treatment.length; x++) {
                if (btn_pressed == x) {
                    var ddl = ddl_treatment[x];
                    var dose = dosage[x];
                    for (var y = 0; y < ddl.length; y++) {
                        if(y == viewable[btn_pressed]){
                            ddl[y].style.display = 'block';
                            dose[y].style.display = 'block';
                            $('#'+btn_pressed+'_remove').show();
                            $('#'+btn_pressed+'_viewable').val(y+1);
                            break;
                        }
                    }
                    if($('#'+ btn_pressed + '_viewable').val() == ddl.length){
                        $('#'+btn_pressed+'_add').prop('disabled', true);
                    }
                }
            }
        }

        function removeTreatment(btn_pressed){
            var ddl_treatment = [];
            var dosage = [];
            var viewable = [];

            //populate the nested array with all the treatments per mouse
            for(var i = 0; i < rows; i++){
                viewable[i] = $('#'+ i + '_viewable').val();
                for(var j = 0; j < treatments; j++) {
                    ddl_treatment[i] = document.getElementsByName(i + '_treatment[]');
                    dosage[i] = document.getElementsByName(i + '_dosage[]');
                }
            }

            //hide all treatments that are beyond the first one.
            for(var x = 0; x < ddl_treatment.length; x++) {
                if (btn_pressed == x) {
                    var ddl = ddl_treatment[x];
                    var dose = dosage[x];
                    for (var y = 0; y < ddl.length+1; y++) {
                        if(y == viewable[btn_pressed] && y != 1){
                            ddl[y-1].style.display = 'none';
                            dose[y-1].style.display = 'none';
                            $('#'+btn_pressed+'_viewable').val(y-1);
                            $('#'+btn_pressed+'_add').prop('disabled', false);
                            break;
                        }
                    }
                    if($('#'+ btn_pressed + '_viewable').val() == 1)
                    {
                        $('#'+btn_pressed+'_remove').hide();
                    }
                }
            }
        }
    </script>
    <style type="text/css">
        /*Prevent disabled radios from being clicked*/
        button[disabled]{
            pointer-events:none;
            background-color: #3B3838;
            color: lightgrey;
        }
    </style>

@endsection