@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="panel panel-default third-x2">
                <div class="panel-heading"><h3>Test Subject Management</h3></div>
                <div class="panel-body">
                    @foreach ($colonies as $colony)
                        @if($colony->active)
                            <a class="btn btn-lg btn-block"
                               href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">
                                {{$colony->name}}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default third last">
                <div class="panel-heading"><h3>Add Test Subject</h3></div>
                <div class="panel-body">
                    {!! Form::open(['action' => 'MouseController@create', 'method' => 'get']) !!}
                        <div class="form-group">
                            <label>Add Test Subject</label>
                            <select class="form-control" name="source" id="source">
                                <option value="0">Select source</option>
                                <option value="1">In House</option>
                                <option value="2">External</option>
                            </select>
                        </div>
                        <div id="selectCage" class="form-group">
                            <label>Select Subject's Source Cage:</label>
                            <select class="form-control" name="cage_id" id="cage_id" onchange="lock()">
                                <option value="0">Select Cage </option>
                                @foreach($cages as $cage)
                                    @foreach($mice as $mouse)
                                        @if($mouse->id == $cage->male)
                                            <option value="{{ $cage->id }}">
                                                #{{ $mouse->tagPad($mouse->tags->last()->tag_num) . ' ' .
                                                        $mouse->getGender($mouse->sex) . ' (' .
                                                        $mouse->getGeno($mouse->geno_type_a) . '/' .
                                                        $mouse->getGeno($mouse->geno_type_b) . ')' }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group clearfix">
                            <input value="Add" type="submit" class="btn btn-block" id="create_mice_btn">
                            {{--{!! Form::submit('Add',['class'=>'btn btn-block']) !!}--}}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

