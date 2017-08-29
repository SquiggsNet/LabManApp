@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['action' => 'TagController@store' ]) !!}
        <div class="form-group">
            {!! Form::label('tag_num', 'Tag Number') !!}
            {!! Form::text('tag_num',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('lost_tag', 'Lost Tag') !!}
            {!! Form::text('lost_tag',null ,['class'=>'form-control'])!!}
        </div>
        {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'TagController@index') }}">
            Go Back
        </a>
    </div>
@endsection