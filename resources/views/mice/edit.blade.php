@extends('layouts.app')
{{--    {!! HTML::style('css/lost_tag.css') !!}--}}
@section('content')


<div class="container">
    <h1>Edit Subject</h1>

    {{ Form::open(['action' => ['MouseController@update', $editMouse], 'method' => 'put']) }}
    <div class="panel panel-default col-md-4">
        <div class="panel-heading">Identification</div>
        <div class="panel-body">
            <div class="row">
                <div class="form-group col-xs-4 col-sm-6 col-md-3 col-md-offset-1">
                    <label>Tag No.</label>
                    <input type="text" id="tag_id" class="form-control" maxlength="3" minlength="3" name="tag_id"
                            @if(isset($editMouse->tags->last()->tag_num))
                                value="{{$editMouse->tagPad($editMouse->tags->last()->tag_num )}}"
                                readonly="readonly"
                            @endif/>
                </div>
                <div class="form-group col-xs-4 col-sm-6 col-md-3">
                    <label>Lost Tag</label>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <input type="checkbox" class="form-control" name="lost_tag_cb" id="lost_tag_cb" onclick="newTag()" value="1">
                    </div>
                </div>
                <div class="form-group col-xs-4 col-sm-6 col-md-3" style="display: none" id="new_tag_input">
                    <label>New Tag</label>
                    <input type="text"  id="new_tag_id" maxlength="3" minlength="3" onkeyup="check()" class="form-control" name="new_tag_id" />
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <button type="button" class="btn btn-grey btn-block" data-toggle="collapse" data-target="#ViewAllTags">
                        View All Tags &#8659;
                    </button>
                    <div class="collapse" id="ViewAllTags">
                        @foreach($editMouse->tags->reverse() as $tags)
                            <li class="list-group-item">
                                {{ $editMouse->tagPad($tags->tag_num) }}
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('colony_id', 'Strain') !!}
                <select name="colony_id" id="colony_id" class="form-control">
                    <option value="0">Select Strain...</option>
                    @foreach($colonies as $colony)
                        <option value="{{ $colony->id }}"
                        @if($editMouse->colony_id == $colony->id)
                            selected="selected"
                        @endif
                        >{{ $colony->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('reserved_for', 'Reserved For') !!}
                <select name="reserved_for" id="reserved_for" class="form-control">
                    <option value="">Reserve For...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                        @if($editMouse->reserved_for == $user->id)
                            selected="selected"
                        @endif
                        >{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="panel panel-default col-md-4">
        <div class="panel-heading">Sex and GenoType</div>
        <div class="panel-body">
            <div class="form-group col-xs-6 col-sm-6 col-md-5">
                <label>Sex:</label>
                <select class="form-control" name="sex">
                    <option value="">Select..</option>
                    <option value="1"
                            @if($editMouse->getGender($editMouse->sex) =='M')selected="selected"@endif>Male</option>
                    <option value="0"
                            @if($editMouse->getGender($editMouse->sex) == 'F')selected="selected"@endif>Female</option>
                </select>
            </div>

            <div class="form-group">
                <fieldset>
                    <?php $gene = 4;?>
                    @if(!is_null($editMouse->geno_type_a))
                        <?php $gene = 1;?>
                        @if($editMouse->geno_type_a == 1)
                            <?php $gene += 2; ?>
                        @endif
                        @if($editMouse->geno_type_b == 1)
                            <?php $gene += 2; ?>
                        @endif
                    @endif
                    {!! Form::label('geno_type', 'Geno Type') !!}
                    <div class="btn-group radio-group" data-toggle="buttons">
                            <input type="radio" name="geno" id="geno_check1" value="5"
                            <?php if($gene == 5) echo "checked='checked'" ?>>(+/+)
                            <input type="radio" name="geno" id="geno_check1" value="3"
                            <?php if($gene == 3) echo "checked='checked'" ?>>(+/-)
                            <input type="radio" name="geno" id="geno_check1" value="1"
                            <?php if($gene == 1) echo "checked='checked'" ?>>(-/-)
                    </div>
                </fieldset>
            </div>
            <div class="form-group">
                {!! Form::label('father', 'Father') !!}
                <select name="father" id="father" class="form-control">
                    <option value="0">Select Male Parent..</option>
                    @foreach($mice as $mouse)
                        @if($mouse->sex == 1 and isset($mouse->tags->last()->tag_num))
                            <option value="{{ $mouse->id }}"
                                @if($editMouse->father == $mouse->id) selected="selected" @endif>
                                @foreach($mouse->tags as $tag)
                                    @if($tag->lost_tag == '0')
                                        {{ $mouse->tagPad($tag->tag_num) }}
                                    @endif
                                @endforeach
                                {{$mouse->getGender($mouse->sex)}}
                                ({{$mouse->getGeno($mouse->geno_type_a)}}
                                /{{$mouse->getGeno($mouse->geno_type_b)}})
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('mother_one', 'Mother 1') !!}
                <select name="mother_one" id="mother_one" class="form-control">
                    <option value="null">Select Female Parent..</option>
                    @foreach($mice as $mouse)
                        @if($mouse->sex == 0 && isset($mouse->tags->last()->tag_num))
                            <option value="{{ $mouse->id }}"
                                @if($mouse->id == $editMouse->mother_one) selected="selected" @endif>
                                @foreach($mouse->tags as $tag)
                                    @if($tag->lost_tag == '0')
                                        {{ $mouse->tagPad($tag->tag_num) }}
                                    @endif
                                @endforeach
                                {{$mouse->getGender($mouse->sex)}}
                                ({{$mouse->getGeno($mouse->geno_type_a)}}
                                /{{$mouse->getGeno($mouse->geno_type_b)}})
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('mother_two', 'Mother 2') !!}
                <select name="mother_two" id="mother_two" class="form-control">
                    <option value="0">Select Female Parent..</option>
                    @foreach($mice as $mouse)
                        @if($mouse->getGender($mouse->sex) == 'F' && isset($mouse->tags->last()->tag_num))
                            <option value="{{ $mouse->id }}"
                                @if($editMouse->mother_two == $mouse->id) selected="selected" @endif>
                            @foreach($mouse->tags as $tag)
                                @if($tag->lost_tag == '0')
                                    {{ $mouse->tagPad($tag->tag_num) }}
                                @endif
                            @endforeach
                            {{$mouse->getGender($mouse->sex)}}
                            ({{$mouse->getGeno($mouse->geno_type_a)}}
                            /{{$mouse->getGeno($mouse->geno_type_b)}})
                        </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('mother_three', 'Mother 3') !!}
                <select name="mother_three" id="mother_three" class="form-control">
                    <option value="0">Select Female Parent..</option>
                    @foreach($mice as $mouse)
                        @if($mouse->getGender($mouse->sex) == 'F' and isset($mouse->tags->last()->tag_num))
                            <option value="{{ $mouse->id }}"
                                @if($editMouse->mother_three == $mouse->id) selected="selected"  @endif>
                                @foreach($mouse->tags as $tag)
                                    @if($tag->lost_tag == '0')
                                        {{ $mouse->tagPad($tag->tag_num) }}
                                    @endif
                                @endforeach
                                {{$mouse->getGender($mouse->sex)}}
                                ({{$mouse->getGeno($mouse->geno_type_a)}}
                                /{{$mouse->getGeno($mouse->geno_type_b)}})
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="panel panel-default col-md-4">
        <div class="panel-heading">Date Information</div>
        <div class="panel-body">
            <div class="form-group">
                <label>Birth Date</label>
                <input class="form-control" name="birth_date" type="date" max="9999-12-31" value="{{ $editMouse->birth_date }}"/>
            </div>
            <div class="form-group">
                <label>Wean Date</label>
                <input class="form-control" name="wean_date" type="date" max="9999-12-31" value="{{ $editMouse->wean_date }}"/>
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input class="form-control" name="end_date" type="date" max="9999-12-31" value="{{ $editMouse->end_date }}"/>
            </div>
            <div class="form-group">
                <label>Blood Pressure Last Taken</label>
                <input class="form-control" name="bp_date" type="date"
                        @if(isset($editMouse->blood_pressures->last()->taken_on))
                            value="{{ $editMouse->blood_pressures->last()->taken_on }}"
                        @endif />
            </div>
            <button type="button" class="btn btn-grey btn-block" data-toggle="collapse" data-target="#ViewAllBPs">
                View Previous Dates &#8659;
            </button>
            <div class="collapse" id="ViewAllBPs">
                @if(isset($editMouse->blood_pressures->last()->taken_on))
                    @foreach($editMouse->blood_pressures->reverse() as $bps)
                        <li class="list-group-item">
                            {{ $bps->taken_on }}
                        </li>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="panel panel-default col-md-12 ">
        <div class="panel-heading">Additional Information</div>
        <div class="panel-body">
            <div class="form-group row">
                <label for="weight" class="col-md-1 control-label">Weight</label>
                <div class="input-group col-xs-6 col-sm-6 col-md-2">
                    <div class="input-group">
                        <input class="form-control" name="weight" id="weight" type="number" step="any" aria-describedby="basic-addon2"
                            @if(isset($editMouse->weights->last()->weight))
                                value="{{ $editMouse->weights->last()->weight }}"
                            @endif />
                        <span class="input-group-addon" id="basic-addon2">gms</span>
                    </div>
                    <input class="form-control" name="weight_date" id="weight_date" type="date"
                        @if(isset($editMouse->weights->last()->weight))
                            value="{{ $editMouse->weights->last()->weighed_on }}"
                        @endif />
                </div>
                <div class="form-group row">
                    <div class="input-group col-xs-12 col-sm-6 col-md-4">
                        <button type="button" class="btn btn-grey btn-block" data-toggle="collapse" data-target="#ViewAllWeights">
                            View Previous Weights &#8659;
                        </button>
                        <div class="collapse" id="ViewAllWeights">
                            @if(isset($editMouse->weights->last()->weight))
                                @foreach($editMouse->weights->reverse() as $weights)
                                    <dl class="dl-horizontal">
                                        <dt>{{ $weights->weight . 'g' }}</dt>
                                        <dd>{{ $weights->weighed_on }}</dd>
                                    </dl>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-1 col-sm-1 col-md-2">
                    <label>Sick Report</label>
                    <div class="form-group col-xs-12 col-sm-12 col-md-6">
                        <input type="checkbox" class="form-control" name="sick_report"
                               value="1" @if($editMouse->sick_report) checked="checked" @endif />
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('comments', 'Comments') !!}
                {!! Form::textarea('comments',null ,['class'=>'form-control', 'rows' => 3]) !!}
            </div>
            <div class="col-md-12 ">
                {!! Form::submit('Update',['class'=>'btn btn-default']) !!}
                {!! Form::close() !!}
                <a href="{{ action( 'MouseController@index') }}">
                    Go Back
                </a>
            </div>
        </div>
    </div>

<script type="text/javascript">

    //This function was for button masks on the checkboxes, may be implemented later
    //If not feel free to remove this section.
//    function setChecked() {
//        if(document.getElementById('geno_check1').checked) {
//            $('#plus_plus').click();
//        }
//        if(document.getElementById('geno_check2').checked) {
//            document.getElementById('geno2').style.color = "grey";
//        }
//        if(document.getElementById('geno_check3').checked) {
//            document.getElementById('geno3').addClass('active');
//        }
//    }

    function newTag(){
        var check_box = document.getElementById("lost_tag_cb");
        if(check_box.checked){
            document.getElementById('new_tag_input').style.display = 'block';
        }else{
            document.getElementById('new_tag_input').style.display = 'none';
        }
    }

    function check(){
        var tagArray = <?php echo json_encode($active_tags) ?>;
        var new_tag = document.getElementById('new_tag_id').value;
        var new_tag_input = document.getElementById('new_tag_id');
        for(var i=0; i < tagArray.length; i++){
            if(tagArray[i] == new_tag){
                alert("Tag already in use.");
                new_tag_input.style.backgroundColor = "yellow";
                break;
            }else{
                new_tag_input.style.backgroundColor = "";
            }
        }
    }

    function start(){
//        setChecked();
    }
    window.onload = start();
</script>

@endsection
