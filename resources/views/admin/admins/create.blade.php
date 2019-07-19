@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ $title }}</h3>
            </div>
            <div class="box-body">
                {!! Form::open(['id' => 'create_admin', 'url' => aurl('admin'), 'method' => 'post']) !!}
                <div class="form-group">
                    {!! Form::label('name', trans('admin.name')) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', trans('admin.email')) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', trans('admin.password')) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                {!! Form::button(trans('admin.send'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                {!! Form::close([]) !!}
            </div>
        </div>
    </div>
</div>



@endsection
