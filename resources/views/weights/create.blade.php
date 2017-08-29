@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['action' => '@store' ]) !!}
        <div class="form-group">
            {!! Form::label('weight', 'Weight') !!}
            {!! Form::text('weight',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('mouse_id', 'Mouse ID') !!}
            {!! Form::text('mouse_id',null ,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'WeightController@index') }}">
            Go Back
        </a>
    </div>
@endsection