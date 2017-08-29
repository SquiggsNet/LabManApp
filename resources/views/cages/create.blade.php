@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Create Breeder Cage</div>
            <div class="panel-body">
                <div>
                    <form role="form" method="POST" action="/cages">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="form-group col-xs-6 col-sm-6 col-md-4">
                                <label>Location:</label>
                                <input class="form-control" type="text" id="room_num" name="room_num" />
                            </div>
                            <div class="form-group col-xs-6 col-sm-6 col-md-2">
                                <label>Male:</label>
                                <select name="male" id="male" class="form-control">
                                    <option value="0">Select Male</option>
                                    @foreach($breeder_mice as $mouse)
                                        @if($mouse->sex == 1)
                                            <option value="{{ $mouse->id }}">
                                                @foreach($mouse->tags as $tag)
                                                    @if($tag->lost_tag == '0')
                                                        {{ $mouse->tagPad($tag->tag_num) }}
                                                    @endif
                                                @endforeach
                                                {{$mouse->getGender($mouse->sex)}}
                                                ({{$mouse->getGeno($mouse->geno_type_a)}}
                                                /{{$mouse->getGeno($mouse->geno_type_b)}})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            <div class="row">
                                <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                    <label>Female 1:</label>
                                    <select name="female_one" id="female_one" class="form-control" onchange="checkFemaleOne()">
                                        <option value="0">Select Female 1</option>
                                        @foreach($breeder_mice as $mouse)
                                            @if($mouse->sex == 0)
                                                <option value="{{ $mouse->id }}">
                                                    @foreach($mouse->tags as $tag)
                                                        @if($tag->lost_tag == '0')
                                                            {{ $mouse->tagPad($tag->tag_num) }}
                                                        @endif
                                                    @endforeach
                                                    {{$mouse->getGender($mouse->sex)}}
                                                    ({{$mouse->getGeno($mouse->geno_type_a)}}
                                                    /{{$mouse->getGeno($mouse->geno_type_b)}})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                    <label>Female 2:</label>
                                    <select name="female_two" id="female_two" class="form-control" onchange="checkFemaleTwo()">
                                        <option value="0">Select Female 2</option>
                                        @foreach($breeder_mice as $mouse)
                                            @if($mouse->sex == 0)
                                                <option value="{{ $mouse->id }}">
                                                    @foreach($mouse->tags as $tag)
                                                        @if($tag->lost_tag == '0')
                                                            {{ $mouse->tagPad($tag->tag_num) }}
                                                        @endif
                                                    @endforeach
                                                    {{$mouse->getGender($mouse->sex)}}
                                                    ({{$mouse->getGeno($mouse->geno_type_a)}}
                                                    /{{$mouse->getGeno($mouse->geno_type_b)}})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                    <label>Female 3:</label>
                                    <select name="female_three" id="female_three" class="form-control">
                                        <option value="0">Select Female 3</option>
                                        @foreach($breeder_mice as $mouse)
                                            @if($mouse->sex == 0)
                                                <option value="{{ $mouse->id }}">
                                                    @foreach($mouse->tags as $tag)
                                                        @if($tag->lost_tag == '0')
                                                            {{ $mouse->tagPad($tag->tag_num) }}
                                                        @endif
                                                    @endforeach
                                                    {{$mouse->getGender($mouse->sex)}}
                                                    ({{$mouse->getGeno($mouse->geno_type_a)}}
                                                    /{{$mouse->getGeno($mouse->geno_type_b)}})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6 col-md-2">
                                <button type="submit" class="btn btn-primary">Set Cage</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <a href="{{ action( 'CageController@index') }}">
            Go Back
        </a>
    </div>

<script type="text/javascript">
    function disableDropDowns(){
        var ddl_two = document.getElementById('female_two');
        var ddl_three = document.getElementById('female_three');

        ddl_two.disabled = true;
        ddl_three.disabled = true;
    }

    window.onload = disableDropDowns();
</script>
@endsection