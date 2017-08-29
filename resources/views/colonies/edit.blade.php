@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($colony, ['action' => ['ColonyController@update', $colony], 'method' => 'put']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name',null ,['class'=>'form-control'])!!}
        </div>
        {!! Form::submit('Save Update',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'ColonyController@index') }}">
            Go Back
        </a>
    </div>
@endsection