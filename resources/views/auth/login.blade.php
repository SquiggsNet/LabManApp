@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-centered">
        <div class="third col-centered" id="login">

            <!--{{--<div class="control-label hidden-xs">--}}
            <div class="control-label">
                {!! Html::image('img/lmtLogoFull.png', 'Laboratory Mouse Tracker', array('class' => 'whole' )) !!}
            </div>
            {{--<div class="control-label hidden-sm hidden-md hidden-lg">--}}
                {{--{!! Html::image('img/mmLogoSmoothXS.png', 'Laboratory Mouse Tracker', array('class' => 'whole' )) !!}--}}
            {{--</div>--}}-->

            <form class="form-horizontal sixth-x5 center-block" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control login" name="email" placeholder="username" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control login" placeholder="password" name="password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group half">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary top-buffer">
                        <i class="fa fa-btn fa-sign-in"></i> Login
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{--<footer>--}}
    {{--<div class="whole">--}}
        {{--<p>COPYRIGHT &copy; LABORATORY MOUSE TRACKER 2017. SITE DESIGN BY DEVON TURNER AND SCOTT RAFAEL</p>--}}
    {{--</div>--}}
{{--</footer>--}}
@endsection
