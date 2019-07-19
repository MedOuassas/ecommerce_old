@extends('admin.index')
<?php
$lat = !empty(old('lat'))? old('lat'):'31.62813014039961';
$lng = !empty(old('lng'))? old('lng'):'-7.979238853081597';
?>
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ $title }}</h3>
            </div>
            <div class="box-body">
                {!! Form::open(['id' => 'create', 'url' => aurl('shippings'), 'method' => 'post', 'files' => true]) !!}
                <input type="hidden" id="lat" name="lat" value="{{ $lat }}">
                <input type="hidden" id="lng" name="lng" value="{{ $lng }}">
                <div class="form-group">
                    {!! Form::label('name', trans('admin.name')) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('user_id', trans('admin.user')) !!}
                    {!! Form::select('user_id', App\User::where('level', 'company')->pluck('name', 'id'), old('user_id') ,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('logo', trans('admin.logo')) !!}
                    {!! Form::file('logo', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <div id="maplocation" style="height: 400px;"></div>
                </div>
                {!! Form::button(trans('admin.send'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                <a href="{{ aurl('shippings') }}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
                {!! Form::close([]) !!}
            </div>
        </div>
    </div>
</div>

@endsection
@push('jscript')
<script type="text/javascript" src='http://maps.google.com/maps/api/js?key=AIzaSyAegDbIoBUtOkrawryONGwpQ4gixK9XKjY&sensor=false&libraries=places'></script>
<script src="{{ asset('design/admin/js/locationpicker.jquery.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#maplocation').locationpicker({
            location: {
                latitude: {{ $lat }},
                longitude: {{ $lng }}
            },
            locationName: "",
            //radius: 500,
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: true,
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng'),
                //radiusInput: null,
                //locationNameInput: $('#address')
            },
            addressFormat: 'postal_code',
            draggable: true,
            onchanged: function(currentLocation, radius, isMarkerDropped) {
                $('#lat').val(currentLocation.latitude);
                $('#lng').val(currentLocation.longitude);
            },
            onlocationnotfound: function(locationName) {
                //$('#address').val(currentLocation.latitude)
            },
            oninitialized: function (component) {},
            markerIcon: "{{ asset('design/admin/img/marker.png') }}",
        });
    });
</script>
@endpush