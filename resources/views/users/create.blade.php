@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        <div class="panel panel-default whole">
            <div class="panel-heading text-center">
                <h2>New User Information</h2>
            </div>
            <div class="panel-body">
                {!! Form::open(['action' => 'UserController@store']) !!}
                <div class="form-group col-lg-6">
                    {!! Form::label('first_name', 'First Name') !!}
                    {!! Form::text('first_name',null ,['class'=>'form-control'])!!}
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('last_name', 'Last Name') !!}
                    {!! Form::text('last_name',null ,['class'=>'form-control'])!!}
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email',null ,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3">
                    {!! Form::label('phone', 'Phone Number') !!}
                    {!! Form::text('phone',null ,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3">
                    {!! Form::label('student_id', 'Student/Faculty ID') !!}
                    {!! Form::text('student_id',null ,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3">
                    {!! Form::label('password', 'Default Password') !!}
                    {{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control', 'autocomplete' => 'new-password')) }}
                </div>
                <div class="form-group col-lg-3 top-buffer">
                    {!! Form::checkbox('admin', 'true') !!}
                    {!! Form::label('Admin', 'Administrator') !!}
                </div>
                <div class="form-group col-lg-3">
                    {!! Form::submit('Add',['class'=>'btn btn-default btn-lg']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <a href="{{ action( 'UserController@index') }}">
            Go Back
        </a>
    </div>
@endsection