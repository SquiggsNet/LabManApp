@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($bloodPressure, ['action' => ['BloodPressureController@update', $bloodPressure], 'method' => 'put']) !!}

        <div class="form-group">
            {!! Form::label('systolic', 'Systolic') !!}
            {!! Form::text('systolic',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('diastolic', 'Diastolic') !!}
            {!! Form::text('diastolic',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('mouse_id', 'Mouse ID') !!}
            {!! Form::text('mouse_id',null ,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Save Update',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'BloodPressureController@index') }}">
            Go Back
        </a>
    </div>
@endsection