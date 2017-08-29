@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading ">Edit Experiment</div>
            <div class="panel-body">
                {!! Form::model($experiment, ['action' => ['ExperimentController@update', $experiment], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title',null ,['class'=>'form-control'])!!}
                </div>
                {!! Form::submit('Save Update',['class'=>'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <a href="{{ action( 'ExperimentController@index') }}">
            Go Back
        </a>
    </div>
@endsection