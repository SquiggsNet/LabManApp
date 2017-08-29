@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading ">Edit Tissue Type</div>
            <div class="panel-body">
                {!! Form::model($tissue, ['action' => ['TissueController@update', $tissue], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name',null ,['class'=>'form-control'])!!}
                </div>
                {!! Form::submit('Save Update',['class'=>'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <a href="{{ action( 'TissueController@index') }}">
            Go Back
        </a>

    </div>
@endsection