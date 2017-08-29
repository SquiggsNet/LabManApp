@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($weight, ['action' => ['WeightController@update', $weight], 'method' => 'put']) !!}

        <div class="form-group">
            {!! Form::label('weight', 'Weight') !!}
            {!! Form::text('weight',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('mouse_id', 'Mouse ID') !!}
            {!! Form::text('mouse_id',null ,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Save Update',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'WeightController@index') }}">
            Go Back
        </a>
    </div>
@endsection