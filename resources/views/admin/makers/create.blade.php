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
                {!! Form::open(['id' => 'create', 'url' => aurl('makers'), 'method' => 'post', 'files' => true]) !!}
                <input type="hidden" id="lat" name="lat" value="{{ $lat }}">
                <input type="hidden" id="lng" name="lng" value="{{ $lng }}">
                <div class="form-group">
                    {!! Form::label('name_en', trans('admin.name_en')) !!}
                    {!! Form::text('name_en', old('name_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name_ar', trans('admin.name_ar')) !!}
                    {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('contact_name', trans('admin.contact_name')) !!}
                    {!! Form::text('contact_name', old('contact_name'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', trans('admin.email')) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('mobile', trans('admin.mobile')) !!}
                    {!! Form::tel('mobile', old('mobile'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('facebook', trans('admin.facebook')) !!}
                    {!! Form::text('facebook', old('facebook'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('website', trans('admin.website')) !!}
                    {!! Form::text('website', old('website'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('logo', trans('admin.logo')) !!}
                    {!! Form::file('logo', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', trans('admin.address')) !!}
                    {!! Form::text('address', old('address'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <div id="maplocation" style="height: 400px;"></div>
                </div>
                {!! Form::button(trans('admin.send'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                <a href="{{ aurl('makers') }}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
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
                locationNameInput: $('#address')
            },
            enableAutocomplete: true,
            enableAutocompleteBlur: false,
            autocompleteOptions: null,
            addressFormat: 'postal_code',
            enableReverseGeocode: true,
            draggable: true,
            onchanged: function(currentLocation, radius, isMarkerDropped) {
                $('#lat').val(currentLocation.latitude);
                $('#lng').val(currentLocation.longitude);
            },
            onlocationnotfound: function(locationName) {
                $('#address').val(currentLocation.latitude)
            },
            oninitialized: function (component) {},
            // must be undefined to use the default gMaps marker
            markerIcon: "{{ asset('design/admin/img/marker.png') }}",
            markerDraggable: true,
            markerVisible : true
        });
    });
</script>
@endpush