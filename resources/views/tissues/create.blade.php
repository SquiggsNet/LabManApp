@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['action' => 'TissueController@store' ]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name',null ,['class'=>'form-control'])!!}
        </div>
        {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'TissueController@index') }}">
            Go Back
        </a>
    </div>
@endsection