@extends('admin.index')
<?php
$lat = !empty($shipping->lat)? $shipping->lat:old('lat');
$lng = !empty($shipping->lng)? $shipping->lng:old('lng');
?>
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ $title }}</h3>
            </div>
            <div class="box-body">
                {!! Form::open(['id' => 'edit', 'url' => aurl('shippings/'.$shipping->id), 'method' => 'put', 'files' => true]) !!}
                <input type="hidden" id="lat" name="lat" value="{{$lat}}">
                <input type="hidden" id="lng" name="lng" value="{{$lng}}">
                <div class="form-group">
                    {!! Form::label('name', trans('admin.name')) !!}
                    {!! Form::text('name', $shipping->name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('user_id', trans('admin.user')) !!}
                    {!! Form::select('user_id', App\User::where('level', 'company')->pluck('name', 'id'), $shipping->user_id ,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('logo', trans('admin.logo')) !!}
                    {!! Form::file('logo', ['class' => 'form-control']) !!}
                </div>
                @if(!empty($shipping->logo))
                <div class="form-group"><img src="{{ Storage::url($shipping->logo) }}" alt="{{ $shipping->name }}" style="max-width:100px"></div>
                @endif
                <div class="form-group">
                    <div id="maplocation" style="height: 400px;"></div>
                </div>
                {!! Form::button(trans('admin.save'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
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
            enableAutocomplete: false,
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
                //$('#address').val(currentLocation.latitude)
            },
            oninitialized: function (component) {},
            markerIcon: "{{ asset('design/admin/img/marker.png') }}",
            markerDraggable: true,
            markerVisible : true
        });
    });
</script>
@endpush