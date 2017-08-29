@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Surgeries</h1>
    @foreach ($surgeries as $surgery)
        <div class="panel panel-default whole">
            <div class="panel-heading">
                <div class="col-lg-3">
                    <h3>{{$surgery->title}}</h3>
                </div>
                <div class="col-lg-4 pull-right">
                    <h3 class="pull-left">Surgeon:  {{ $surgery->user->getFullName() }}</h3>
                    {{ Form::open(['action' => ['SurgeryController@edit', $surgery], 'method' => 'get']) }}
                    <button type="submit" class="pull-right float-right" >
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    {{ Form::close() }}
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="col-lg-2 pull-right bottom-buffer">
                    {{ Form::open(['action' => ['SurgeryController@destroy', $surgery->id], 'method' => 'delete', 'onsubmit' => 'return confirmDelete()']) }}
                    <button type="submit" class="btn btn-default pull-right" >
                        Delete Surgery
                    </button>
                    {{ Form::close() }}
                    </div>
                {{ Form::open(array('url' => 'mice/groupTagged')) }}
                <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                    <thead>
                    <tr>
                        <th></th>
                        <th data-field="tag" >Tag</th>
                        <th>Strain</th>
                        <th>Genotype</th>
                        <th>Age</th>
                        <th>Surgery Date</th>
                        <th>Treatment</th>
                        <th>Dosage</th>
                        <th>End Date</th>
                        <th>Experimental Use</th>
                        <th>End User</th>
                        {{--<th></th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($surgery->mice as $mouse)
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
                                    <td>{{ $mouse->getAge($mouse->birth_date) }}</td>
                                    <td>{{ $mouse->showDate($surgery->scheduled_date) }}</td>
                                    <td>
                                        @foreach($mouse->treatments as $treatments)
                                            {{ $treatments->title }} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($mouse->treatments as $treatments)
                                            {{ $treatments->pivot->dosage }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $mouse->showDate($surgery->end_date) }}</td>
                                    <td>
                                        @foreach($mouse->experiments as $experiments)
                                            {{ $experiments->title }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if(!empty($mouse->reserved_for))
                                            {{ $mouse->getUserName($mouse->reserved_for) }}
                                        @endif
                                    </td>
                                    {{--<td>--}}
                                        {{--{!! Form::open(['action' => ['SurgeryController@remove', $surgery],--}}
                                         {{--'method' => 'post', 'onsubmit' => 'return confirmRemove()']) !!} --}}{{--<- Doesn't confirm for some unknown reason--}}
                                        {{--<input type="hidden" name="mouse" value="{{ $mouse->id }}" />--}}
                                        {{--<button type="submit" >--}}
                                            {{--<span class="glyphicon glyphicon-trash"></span>--}}
                                        {{--</button>--}}
                                        {{--{{ Form::close() }}--}}
                                    {{--</td>--}}
                                </tr>
                            @endif
                    @endforeach
                    </tbody>
                </table>

                <input type="button" value="Euthanize" id="euthStorage{{$surgery->id}}" class="btn_euthanize btn btn-default pull-left sixth show_btn"/>

                <div class="euthStorage form-group quarter euthStorage{{$surgery->id}}">
                    <label>Storage Type:</label>
                    <select class="form-control storage" name="storage" id="submit_euthanize{{$surgery->id}}">
                        <option value="0">Select Storage</option>
                        @foreach($storages as $storage)
                            <option value="{{$storage->type}},{{$storage->id}}">
                                @if($storage->type == 1)
                                    (-80&deg;C) Freezer {{$storage->identifier}}
                                @else
                                    Histology {{$storage->identifier}}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" name="submit" value="euthanize" id="submit_euthanize{{$surgery->id}}" class="submit_euthanize{{$surgery->id}} submit_euthanize btn btn-default pull-left btn-block sixth show_btn">
                    Next
                </button>

                {{ Form::close() }}
            </div>
        </div>
    @endforeach
    <a href="{{ action( 'MouseController@index') }}">
        Create a New Surgery
    </a>
</div>
@endsection