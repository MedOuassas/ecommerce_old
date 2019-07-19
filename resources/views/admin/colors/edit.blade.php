@extends('admin.index')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ $title }}</h3>
            </div>
            <div class="box-body">
                {!! Form::open(['id' => 'edit', 'url' => aurl('colors/'.$color->id), 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('name', trans('admin.name')) !!}
                    {!! Form::text('name', $color->name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('color', trans('admin.color')) !!}
                    <div id="colorp" class="input-group colorpicker-component">
                        {!! Form::text('color', $color->color ,['class' => 'form-control']) !!}
                        <div class="btn input-group-addon colorpicker-input-addon" type="submit"><i></i></div>
                    </div>
                </div>
                {!! Form::button(trans('admin.save'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                <a href="{{ aurl('colors') }}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
                {!! Form::close([]) !!}
            </div>
        </div>
    </div>
</div>

@endsection

@push('jscript')
<link rel="stylesheet" href="{{ asset('design/admin/css/bootstrap-colorpicker.min.css') }}">
<script src="{{ asset('design/admin/js/bootstrap-colorpicker.min.js') }}"></script>
<script>
$(function() {
    $('#colorp').colorpicker({
        color: '{{$color->color}}',
        format: 'hex',
        colorSelectors: {
            'black': '#000000',
            'white': '#ffffff',
            'red': '#FF0000',
            'default': '#777777',
            'primary': '#337ab7',
            'success': '#5cb85c',
            'info': '#5bc0de',
            'warning': '#f0ad4e',
            'danger': '#d9534f'
        }
    });
});
</script>
@endpush
