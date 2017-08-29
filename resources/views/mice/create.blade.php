@extends('layouts.app')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


@section('content')

@if($source == "1")
    <div class="container">
        <h1 class="row-centered">Add Test Subject</h1>
        {!! Form::open((array('route' => 'mice.store'))) !!}
        <input type="hidden" name="source" id="source" value="In house"/>
        <div class="panel panel-default quarter">
            <div class="panel-heading">Quantity</div>
            <div class="panel-body">
                <div class="form-group">
                    <label># Of Subjects:</label>
                    <div class="input-group">
                        <span class="input-group-btn ">
                            <button type="button" class="btn btn-default value-control" data-action="minus" data-target="quantity">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </span>
                        <input type="text" name="mice_number" value="0" min="0" maxlength="2" class="form-control" id="quantity">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default value-control" data-action="plus" data-target="quantity">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default quarter new_last">
            <div class="panel-heading">DOB/Source</div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Date of Birth:</label>
                    <input class="form-control" type="date" max="9999-12-31" name="date_of_birth" />
                </div>
                <div class="form-group">
                    <label>Colony:</label>
                    <select class="form-control" name="colony_id">
                        <option value="0">Select Source...</option>
                        @foreach($colonies as $colony)
                            @if(!$colony->external)
                                <option value="{{ $colony->id }}">{{ $colony->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="panel panel-default quarter">
            <div class="panel-heading">Parents</div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Male Parent:</label>
                    <label>
                        @foreach($mice as $mouse)
                            @if($mouse->id == $cage->male)
                                <input class="form-control" type="text" name="male_parent" readonly="readonly"
                                       value=" #{{ $mouse->tagPad($mouse->tags->last()->tag_num) . ' ' .
                                                            $mouse->getGender($mouse->sex) . ' (' .
                                                            $mouse->getGeno($mouse->geno_type_a) . '/' .
                                                            $mouse->getGeno($mouse->geno_type_b) . ')' }} "/>
                            @endif
                        @endforeach
                    </label>
                </div>
                <div class="form-group">
                    <label>Select Female Parent:</label>
                    <input type="hidden" name="cage_id" value="{{ $cage->id }}"/>
                    <select class="form-control" name="female_parent">
                        <option value="0">Select All (Unknown)</option>
                        @foreach($mice as $mouse)
                            @if($mouse->id == $cage->female_one)
                                <option value="{{ $mouse->id }}">
                                    {{ $mouse->tagPad($mouse->tags->last()->tag_num) . ' ' .
                                        $mouse->getGender($mouse->sex) . ' (' .
                                        $mouse->getGeno($mouse->geno_type_a) . '/' .
                                        $mouse->getGeno($mouse->geno_type_b) . ')' }}
                                </option>
                            @endif
                            @if($mouse->id == $cage->female_two)
                                <option value="{{ $mouse->id }}">
                                    {{ $mouse->tagPad($mouse->tags->last()->tag_num) . ' ' .
                                        $mouse->getGender($mouse->sex) . ' (' .
                                        $mouse->getGeno($mouse->geno_type_a) . '/' .
                                        $mouse->getGeno($mouse->geno_type_b) . ')' }}
                                </option>
                            @endif
                            @if($mouse->id == $cage->female_three)
                                <option value="{{ $mouse->id }}">
                                    {{ $mouse->tagPad($mouse->tags->last()->tag_num) . ' ' .
                                        $mouse->getGender($mouse->sex) . ' (' .
                                        $mouse->getGeno($mouse->geno_type_a) . '/' .
                                        $mouse->getGeno($mouse->geno_type_b) . ')' }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="panel panel-default quarter last">
            <div class="panel-heading">Batch</div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Comments:</label>
                    <textarea class="form-control" rows="5" name="comments" ></textarea>
                </div>
            </div>
        </div>

        <div class="form-group quarter last pull-right">
            {!! Form::submit('Add Subjects',['class'=>'btn btn-default btn-block']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@else
    <div class="container">
        <h1 class="row-centered">Add Test Subject</h1>
        <div class="panel panel-default">
            <div class="panel-heading">External</div>
            <div class="panel-body">
                <div>
                    {!! Form::open((array('route' => 'mice.store'))) !!}
                    <div class="row">
                        <input type="hidden" name="source" id="source" value="External"/>
                        <div class="form-group col-xs-6 col-sm-6 col-md-2">
                            <label># Of Subjects:</label>
                            <div class="input-group">
                                    <span class="input-group-btn ">
                                        <button type="button" class="btn btn-default value-control" data-action="minus" data-target="quantity">
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                <input type="text" name="mice_number" value="0" min="0" maxlength="2" class="form-control" id="quantity">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn-default value-control" data-action="plus" data-target="quantity">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-3">
                            <label>Date Received:</label>
                            <input class="form-control" type="date" name="date_received" />
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-3">
                            <label>Source:</label>
                            <select class="form-control" name="colony_id">
                                <option value="0">Select Strain...</option>
                                @foreach($colonies as $colony)
                                    @if($colony->external)
                                        <option value="{{ $colony->id }}">{{ $colony->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6 col-md-2">
                            {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@endsection