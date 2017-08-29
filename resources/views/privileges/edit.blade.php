@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($privilege, ['action' => ['PrivilegeController@update', $privilege], 'method' => 'put']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name',null ,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Save Update',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'PrivilegeController@index') }}">
            Go Back
        </a>
    </div>
@endsection