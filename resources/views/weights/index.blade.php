@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Weights</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Weights</th>
            <th>Mouse ID</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($weights as $weight)
        <tr>
            <td>
                <a href="{{ action( 'WeightController@show', ['id' => $weight->id]) }}">
                    {{$weight->id}}
                </a>
            </td>
            <td>{{$weight->weight}}</td>
            <td>{{$weight->mouse_id}}</td>
            <td>
                {{ Form::open(['action' => ['WeightController@edit', $weight], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['WeightController@destroy', $weight], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'WeightController@create') }}">
        Create a New Weight
    </a>
</div>
@endsection