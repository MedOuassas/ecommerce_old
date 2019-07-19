@extends('admin.index')


@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ $title }}</h3>
            </div>
            <div class="box-body">
                {!! Form::open(['id' => 'create', 'url' => aurl('cities'), 'method' => 'post']) !!}
                <div class="form-group">
                    {!! Form::label('city_name_en', trans('admin.city_name_en')) !!}
                    {!! Form::text('city_name_en', old('city_name_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('city_name_ar', trans('admin.city_name_ar')) !!}
                    {!! Form::text('city_name_ar', old('city_name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_id', trans('admin.country')) !!}
                    {!! Form::select('country_id', App\Model\Country::pluck('country_name_en','id'), old('country_id'), ['class' => 'form-control']) !!}
                </div>
                {!! Form::button(trans('admin.send'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                <a href="{{ aurl('cities') }}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
                {!! Form::close([]) !!}
            </div>
        </div>
    </div>
</div>


@endsection