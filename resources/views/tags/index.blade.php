@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tags</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tag Number</th>
            <th>Lost Tag</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tags as $tag)
        <tr>
            <td>
                <a href="{{ action( 'TagController@show', ['id' => $tag->id]) }}">
                    {{$tag->id}}
                </a>
            </td>
            <td>{{$tag->tag_num}}</td>
            <td>{{$tag->lost_tag}}</td>
            <td>
                {{ Form::open(['action' => ['TagController@edit', $tag], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['TagController@destroy', $tag], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'TagController@create') }}">
        Create a New Tag
    </a>
</div>
@endsection