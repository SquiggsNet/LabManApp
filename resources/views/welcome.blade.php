@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cardiovascular Research (Name of Research Facility)</div>

                <div class="panel-body">
                    Logo and/or Login Screen... once logged in, user will automatically be brought to home:
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
