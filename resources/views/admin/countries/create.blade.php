@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ $title }}</h3>
            </div>
            <div class="box-body">
                {!! Form::open(['id' => 'create_country', 'url' => aurl('countries'), 'method' => 'post', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('country_name_en', trans('admin.country_name_en')) !!}
                    {!! Form::text('country_name_en', old('country_name_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_name_ar', trans('admin.country_name_ar')) !!}
                    {!! Form::text('country_name_ar', old('country_name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('code', trans('admin.code')) !!}
                    {!! Form::text('code', old('code'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('mob', trans('admin.mob')) !!}
                    {!! Form::text('mob', old('mob'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('logo', trans('admin.logo')) !!}
                    {!! Form::file('logo', ['class' => 'form-control']) !!}
                </div>
                {!! Form::button(trans('admin.send'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                <a href="{{ aurl('countries') }}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
                {!! Form::close([]) !!}
            </div>
        </div>
    </div>
</div>



@endsection
