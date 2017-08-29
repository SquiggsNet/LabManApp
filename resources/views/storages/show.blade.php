@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="row-centered">Freezer #{{$storage->identifier}}</h1>
        @foreach ($storage->compartments as $compartment)
        <div class="panel panel-default whole">
            <div class="panel-heading">
                <h3>{{$compartment->description}} Compartment</h3>
            </div>
            <div class="panel-body">
                @foreach($compartment->shelves as $shelf)
                    <h4>{{$shelf->description}} Shelf</h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Box #</th>
                                <th>Column</th>
                                <th>Row</th>
                                <th>Capacity</th>
                            </tr>
                        </thead>
                    <tbody>
                    @foreach ($shelf->boxes as $box)
                        <tr>
                            <td>
                                <input type="checkbox" id="group_select_cb" name="group_select_cb[]" value="{{ $box->id }}"/>
                            </td>
                            <td>
                                <a href="{{ action( 'BoxController@show', ['id' => $box->id]) }}">
                                    {{$box->box}}
                                </a>
                            </td>
                            <td>{{$box->column}}</td>
                            <td>{{$box->row}}</td>
                            <td>{{$box->mouse_storages->count()}}/{{$box->capacity}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
@endsection