@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="row-centered">Euthanize</h1>
        <div class="panel panel-default whole">
            <div class="panel-heading"><h3>Tissue Region Selection</h3></div>
            <div class="panel-body">
                {!! Form::open(['action' => 'BoxController@store' ]) !!}
                    <table class="table table-bordered table-striped" id="mice_table" data-toggle="table">
                        <thead>
                            <tr>
                                <th>Tag#</th>
                                @foreach ($tissues as $tissue)
                                    <td>{{$tissue->name}}</td>
                                @endforeach
                                <th>Box</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $m_num = 0;?>
                            @foreach($mice as $mouse)
                                <tr>
                                    <td>{{ $mouse->tagPad($mouse->tags->last()->tag_num) }}</td>
                                    @foreach($tissues as $tissue)
                                        <td>
                                            <input type="checkbox" name="{{ $m_num }}_tissue[]" value="{{ $tissue->id }}"/>
                                        </td>
                                    @endforeach
                                    <td>
                                        <select class="form-control" name="{{ $m_num }}_box[]" >
                                            <option value="0">Select Box </option>
                                            @foreach($boxes as $box)
                                                <option value="{{ $box->id }}">
                                                    {{ $box->column }}{{ $box->row }} - {{ $box->box }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </td>
                                </tr>
                                <?php $m_num++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach ($mice as $mouse)
                        <input type="hidden" name="euthanize_mice[]" value="{{$mouse->id}}"/>
                    @endforeach
                    <div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label class="form-label" >Surgeon</label>
                                <select name="surgeon" id="surgeon" class="form-control">
                                    <option value="0">Select Surgeon...</option>
                                    @foreach($surgeons as $surgeon)
                                        <option value="{{ $surgeon->id }}">
                                            {{$surgeon->first_name . ' ' . $surgeon->last_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label class="form-label" >Extraction Date</label>
                                <input class="form-control"  id="date" name="extraction_date" type="date"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::submit('Confirm',['class'=>'btn btn-default pull-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection