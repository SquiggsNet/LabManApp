@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="row-centered">Euthanize</h1>
        <div class="panel panel-default whole">
            <div class="panel-heading"><h3>Tissue Region Selection</h3></div>
            <div class="panel-body">
                {!! Form::open(['action' => 'StorageController@store' ]) !!}
                    <table class="table table-bordered table-striped" id="mice_table" data-toggle="table">
                        <thead>
                            <tr>
                                <th>Tag#</th>
                                @foreach ($tissues as $tissue)
                                    <td>{{$tissue->name}}</td>
                                @endforeach
                                <th>Box</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mice as $mouse)
                                <tr>
                                    <td>{{ $mouse->tagPad($mouse->tags->last()->tag_num) }}</td>
                                    @foreach($tissues as $tissue)
                                        <td>
                                            <input type="checkbox" id="group_select_cb" name="group_select_cb[]" value="{{ $tissue->id }}"/>
                                        </td>
                                    @endforeach
                                    <td>
                                        <select class="form-control" name="box_id" id="box_id">
                                            <option value="0">Select Box </option>
                                            @foreach($boxes as $box)
                                                <option value="{{ $box->id }}">
                                                    {{ $box->column }}{{ $box->row }} - {{ $box->box }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group col-md-12">
                        {!! Form::submit('Confirm',['class'=>'btn btn-default pull-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

        {{--{!! Form::open(['action' => 'StorageController@store' ]) !!}--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('tissue_id', 'Tissue ID') !!}--}}
            {{--{!! Form::text('tissue_id',null ,['class'=>'form-control'])!!}--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('type', 'Type') !!}--}}
            {{--{!! Form::text('type',null ,['class'=>'form-control'])!!}--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('freezer', 'Freezer') !!}--}}
            {{--{!! Form::text('freezer',null ,['class'=>'form-control']) !!}--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('compartment', 'Compartment') !!}--}}
            {{--{!! Form::text('compartment',null ,['class'=>'form-control']) !!}--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('shelf', 'Shelf') !!}--}}
            {{--{!! Form::text('shelf',null ,['class'=>'form-control']) !!}--}}
        {{--</div>--}}
        {{--{!! Form::submit('Add',['class'=>'btn btn-default']) !!}--}}
        {{--{!! Form::close() !!}--}}

        {{--<a href="{{ action( 'StorageController@index') }}">--}}
            {{--Go Back--}}
        {{--</a>--}}

    </div>
@endsection