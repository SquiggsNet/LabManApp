@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Storages</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tissue ID</th>
            <th>Type</th>
            <th>Freezer</th>
            <th>Compartment</th>
            <th>Shelf</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($storages as $storage)
        <tr>
            <td>
                <a href="{{ action( 'StorageController@show', ['id' => $storage->id]) }}">
                    {{$storage->id}}
                </a>
            </td>
            <td>{{$storage->tissue_id}}</td>
            <td>{{$storage->type}}</td>
            <td>{{$storage->freezer}}</td>
            <td>{{$storage->compartment}}</td>
            <td>{{$storage->shelf}}</td>
            <td>
                {{ Form::open(['action' => ['StorageController@edit', $storage], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['StorageController@destroy', $storage], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'StorageController@create') }}">
        Create a New Storage
    </a>
</div>
@endsection