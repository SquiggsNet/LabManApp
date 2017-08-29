@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($errors->all() as $error)
            <li style="color: red;">{{$error}}</li>
        @endforeach
        <div class="panel panel-default whole">
            <div class="panel-heading text-center">
                <h2>Edit User Information</h2>
            </div>
            <div class="panel-body">
                {!! Form::model($user, ['action' => ['UserController@update', $user], 'method' => 'put']) !!}
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
                    {!! Form::text('phone',null ,array('class'=>'form-control', 'maxlength' => 10)) !!}
                </div>
                <div class="form-group col-lg-3">
                    {!! Form::label('student_id', 'Student/Faculty ID') !!}
                    {!! Form::text('student_id',null ,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 top-buffer">
                    <input type="checkbox" id="reset_password" name="reset_password" value="1" onchange="hide_password()" />
                    {!! Form::label('reset_label', 'Reset Password', ['id' => 'reset_label']) !!}
                </div>
                <div class="form-group col-lg-3" id="new_password">
                    {!! Form::label('password', 'Default Password', array('id' => 'password_label')) !!}
                    {{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control', 'autocomplete' => 'new-password')) }}
                </div>
                <div class="form-group col-lg-3 top-buffer">
                    {!! Form::checkbox('admin') !!}
                    {!! Form::label('Admin', 'Administrator') !!}
                </div>
                <div class="form-group col-lg-3">
                    {!! Form::submit('Update',['class'=>'btn btn-default btn-lg']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <a href="{{ action( 'UserController@index') }}">
            Go Back
        </a>
    </div>
@endsection