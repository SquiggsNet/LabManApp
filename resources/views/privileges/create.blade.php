@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['action' => 'PrivilegeController@store' ]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name',null ,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'PrivilegeController@index') }}">
            Go Back
        </a>
    </div>
@endsection