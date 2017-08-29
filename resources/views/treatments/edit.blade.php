@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading ">Edit Tissue Type</div>
            <div class="panel-body">
            {!! Form::model($treatment, ['action' => ['TreatmentController@update', $treatment], 'method' => 'put']) !!}

            <div class="form-group">
                {!! Form::label('title', 'Title') !!}
                {!! Form::text('title',null ,['class'=>'form-control'])!!}
            </div>
            {!! Form::submit('Save Update',['class'=>'btn btn-default']) !!}
            {!! Form::close() !!}
            </div>
        </div>
        <a href="{{ action( 'TreatmentController@index') }}">
            Go Back
        </a>
    </div>
@endsection