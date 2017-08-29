@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($tag, ['action' => ['TagController@update', $tag], 'method' => 'put']) !!}

        <div class="form-group">
            {!! Form::label('tag_num', 'Tag Number') !!}
            {!! Form::text('tag_num',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('lost_tag', 'Lost Tag') !!}
            {!! Form::text('lost_tag',null ,['class'=>'form-control'])!!}
        </div>
        {!! Form::submit('Save Update',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'TagController@index') }}">
            Go Back
        </a>
    </div>
@endsection