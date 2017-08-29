@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="row-centered">{{$colony->name}} Subjects</h1>

        <div class="panel panel-default whole">
            <div class="panel-heading"><h3>Tagged Subjects</h3></div>
            <div class="panel-body">
                <a id="breeders_link" class="btn btn-default pull-right btn-block sixth bottom-buffer last"
                   href="{{ action( 'CageController@index') }}">
                    Sources
                </a>
                {{ Form::open(array('url' => 'mice/groupTagged')) }}
                <table class="table table-bordered table-striped" id="colony_mice_table" data-toggle="table" >
                    <thead>
                    <tr>
                        <th></th>
                        <th data-field="tag" >Tag</th>
                        <th>Source</th>
                        <th>Genotype</th>
                        <th>DOB</th>
                        <th>Age</th>
                        <th>Weight</th>
                        <th>Reserved For</th>
                        <th>Comments</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($colony->mice as $mouse)
                        @if(isset($mouse->tags->last()->tag_num))
                            @if($mouse->sex == "1")
                                <?php $class = "info" ?>
                            @elseif($mouse->sex == "0" and !is_null($mouse->sex))
                                <?php $class = "danger" ?>
                            @else
                                <?php $class = "" ?>
                            @endif
                            @if($mouse->sick_report)
                                <?php $id = "report" ?>
                            @else
                                <?php $id = "no_report" ?>
                            @endif
                            <tr class="{{ $class }}" id="{{ $id }}">
                                <td>
                                    <input type="checkbox" id="group_select_cb" name="group_select_cb[]" value="{{ $mouse->id }}"/>
                                </td>
                                <td>
                                    <a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">
                                        {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ action( 'ColonyController@show', ['id' => $mouse->colony->id]) }}">
                                        {{$mouse->colony->name}}
                                    </a>
                                </td>
                                <td>{{ $mouse->genoFormat($mouse->geno_type_a, $mouse->geno_type_b) }}</td>
                                <td>{{ $mouse->showDate($mouse->birth_date) }}</td>
                                <td>{{$mouse->getAge($mouse->birth_date)}} weeks</td>
                                <td>
                                    @if(!empty($mouse->weights->last()->weight))
                                        {{$mouse->weights->last()->weight . 'g'}}
                                    @endif
                                </td>
                                <td>{{$mouse->users}}</td>
                                <td>
                                    <?php $i=1; $len = count($mouse->comments); ?>
                                    @foreach($mouse->comments as $comments)
                                        @if($i == $len)
                                            {{ $comments->comment }}
                                        @endif
                                        <?php $i++; ?>
                                    @endforeach
                                </td>
                                <td>
                                    {{ Form::open(['action' => ['MouseController@edit', $mouse], 'method' => 'get']) }}
                                    <button type="submit" >
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    {{ Form::close() }}
                                </td>
                                <td>
                                    {{ Form::open(['action' => ['MouseController@destroy', $mouse], 'method' => 'delete']) }}
                                    <button type="submit" >
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

                <button type="submit" name="submit" value="edit" id="submit_edit" class="btn btn-default pull-left btn-block sixth">
                    Edit
                </button>

                <button type="submit" name="submit" value="surgery" id="submit_surgery" class="btn btn-default pull-left btn-block sixth show_btn">
                    Create Surgery
                </button>

                <button type="submit" name="submit" value="euthanize" id="submit_euthanize" class="btn btn-default pull-left btn-block sixth show_btn">
                    Eunthanize
                </button>

                {{ Form::close() }}
                {{ Form::open(['action' => ['MouseController@index'], 'method' => 'get']) }}
                <button type="submit" class="btn btn-default pull-right btn-block sixth last">
                    <input type="hidden" name="pep_mice"/>
                    View Archived Subjects
                </button>
                {{ Form::close() }}

            </div>
        </div>
        <div class="panel panel-default whole">
            <div class="panel-heading"><h3>Untagged Subjects</h3></div>
            <div class="panel-body">

                {{ Form::open(array('url' => 'mice/groupUntagged')) }}
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Remove</th>
                        <th>Tag</th>
                        <th>Set Sex</th>
                        <th>Sex</th>
                        <th>Parents</th>
                        <th>DOB</th>
                        <th>Wean Date</th>
                        <th>Comments</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($colony->mice as $mouse)
                        @if(!isset($mouse->tags->last()->tag_num))
                            @if($mouse->sex == "1")
                                <?php $class = "info" ?>
                            @elseif($mouse->sex == "0")
                                <?php $class = "danger" ?>
                            @else
                                <?php $class = "" ?>
                            @endif
                            @if($mouse->sick_report)
                                <?php $id = "report" ?>
                            @else
                                <?php $id = "no_report" ?>
                            @endif
                            <tr class="{{ $class }}" id="{{ $id }}">
                                <td>
                                    <input type="hidden" name="mice[]" id="mice" value="{{ $mouse->id }}"/>
                                    <input type="checkbox" class="untaggedChk" value="{{ $mouse->id }}" id="group_select_untagged_cb"
                                           name="group_select_untagged_cb[]" onchange="checkRemove()"/>

                                </td>
                                <td class="col-sm-2 col-md-1">
                                    <input type="text" id="new_tag_id" maxlength="3" minlength="3"
                                           class="form-control col-md-1" oninput="checkTag()" name="new_tag_id[]"/>
                                </td>
                                {{--<td>{{ $mouse->colony->name }}</td>--}}
                                {{--<td>{{ $mouse->source }}</td>--}}
                                <td>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default" for="sex">
                                            <input type="radio" name="sex[{{ $mouse->id }}]" id="sex" value="1" onchange="checkSex()" />M
                                        </label>
                                        <label class="btn btn-default" for="sex">
                                            <input type="radio" name="sex[{{ $mouse->id }}]" id="sex" value="0" onchange="checkSex()" />F
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    @if(isset($mouse->sex))
                                        {{ $mouse->getGender($mouse->sex) }}
                                    @endif
                                </td>
                                @if($mouse->source == 'In house')
                                    <td>{{$mouse->tagPad($mouse->father_record->tags->last()->tag_num)}}
                                        {{$mouse->getGender($mouse->father_record->sex)}}
                                        ({{$mouse->getGeno($mouse->father_record->geno_type_a)}}/
                                        {{$mouse->getGeno($mouse->father_record->geno_type_b)}}) x
                                        {{$mouse->tagPad($mouse->mother_one_record->tags->last()->tag_num)}}
                                        {{$mouse->getGender($mouse->mother_one_record->sex)}}
                                        ({{$mouse->getGeno($mouse->mother_one_record->geno_type_a)}}/
                                        {{$mouse->getGeno($mouse->mother_one_record->geno_type_b)}})
                                        @if(isset($mouse->mother_two_record->sex))
                                            ,{{$mouse->tagPad($mouse->mother_two_record->tags->last()->tag_num)}}
                                            {{$mouse->getGender($mouse->mother_two_record->sex)}}
                                            ({{$mouse->getGeno($mouse->mother_two_record->geno_type_a)}}
                                            /{{$mouse->getGeno($mouse->mother_two_record->geno_type_b)}})
                                        @endif
                                        @if(isset($mouse->mother_three_record->sex))
                                            ,{{$mouse->tagPad($mouse->mother_three_record->tags->last()->tag_num)}}
                                            {{$mouse->getGender($mouse->mother_three_record->sex)}}
                                            ({{$mouse->getGeno($mouse->mother_three_record->geno_type_a)}}
                                            /{{$mouse->getGeno($mouse->mother_three_record->geno_type_b)}})
                                        @endif</td>
                                @else
                                    <td>N/A</td>
                                @endif

                                <td>{{$mouse->showDate($mouse->birth_date)}}</td>
                                <td>{{$mouse->showDate($mouse->wean_date)}}</td>
                                <td>
                                    <?php $i=1; $len = count($mouse->comments); ?>
                                    @foreach($mouse->comments as $comments)
                                        @if($i == $len)
                                            {{ $comments->comment }}
                                        @endif
                                        <?php $i++; ?>
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                </div>
                <button type="submit" name="submit" value="remove" id="submit_remove" class="btn btn-default pull-left btn-block sixth">
                    Remove
                </button>

                <button type="submit" name="submit" value="tag" id="submit_tag" class="btn btn-default pull-left btn-block sixth show_btn">
                    Tag Selected Subjects
                </button>

                <button type="submit" name="submit" value="sex" id="submit_sex" class="btn btn-default pull-left btn-block sixth show_btn">
                    Assign Sex
                </button>
                {{ Form::close() }}
                <button type="button"  value="clear_sex" id="clear_sex" onclick="clearSex()" class="btn btn-default pull-left btn-block sixth show_btn">
                    Clear Sex
                </button>
            </div>
        </div>
    </div>
    <style type="text/css">
        /*Prevent disabled radios from being clicked*/
        label[disabled]{
            pointer-events:none;
        }
    </style>
@endsection