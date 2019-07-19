@extends('admin.index')
@push('jscript')
<script>
    $(document).ready(function (){
        $(document).on('change', '.country', function (){
            var country = $('.country option:selected').val();
            if(country>0){
                $.ajax({
                    url: '{{aurl('states/create')}}',
                    type: 'get',
                    dataType: 'html',
                    data: {country_id:country,select:''},
                        success: function (data){
                            $('.city').html(data);
                            $('.group_city').removeClass('hidden');
                        }
                });
            } else {
                $('.city').addClass('hidden');
            }
        });
        @if(old('city_id'))
            $.ajax({
                url: '{{aurl('states/create')}}',
                type: 'get',
                dataType: 'html',
                data: {country_id:'{{old('country_id')}}',select:'{{old('city_id')}}'},
                    success: function (data){
                        $('.group_city').removeClass('hidden');
                        $('.city').html(data);
                    }
            });
        @endif
    });
</script>
@endpush

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ $title }}</h3>
            </div>
            <div class="box-body">
                {!! Form::open(['id' => 'create', 'url' => aurl('states'), 'method' => 'post']) !!}
                <div class="form-group">
                    {!! Form::label('state_name_en', trans('admin.state_name_en')) !!}
                    {!! Form::text('state_name_en', old('state_name_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('state_name_ar', trans('admin.state_name_ar')) !!}
                    {!! Form::text('state_name_ar', old('state_name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_id', trans('admin.country')) !!}
                    {!! Form::select('country_id', App\Model\Country::pluck('country_name_en','id'), old('country_id'), ['class' => 'form-control country', 'placeholder'=>trans('admin.country')]) !!}
                </div>
                <div class="form-group group_city hidden">
                    {!! Form::label('city_id', trans('admin.city')) !!}
                    <div class="city"></div>
                </div>
                {!! Form::button(trans('admin.send'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                <a href="{{ aurl('states') }}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
                {!! Form::close([]) !!}
            </div>
        </div>
    </div>
</div>


@endsection