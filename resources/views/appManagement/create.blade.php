@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Data Export</h1>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4>Subjects</h4></div>
                    <div class="panel-body">
                        <h5>Click to download data from subject</h5>
                        {{ Form::open(array('url' => 'mice/export')) }}
                        <button type="submit" name="submit" value="export_mice" id="export_mice" class="btn btn-default pull-left btn-block sixth show_btn">
                        Subject Mice <span class="glyphicon glyphicon-download-alt"></span>
                        </button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4>Storages</h4></div>
                    <div class="panel-body">
                        <h5>Click to download data from storages</h5>
                        {{ Form::open(array('url' => 'storages/export')) }}
                        <button type="submit" name="submit" value="export_storage" id="export_storage" class="btn btn-default pull-left btn-block sixth show_btn">
                            Export Storage <span class="glyphicon glyphicon-download-alt"></span>
                        </button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection