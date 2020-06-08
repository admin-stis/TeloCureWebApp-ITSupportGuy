@extends('frontend.layouts.app')

@section('content')
    @if ($title == 'patient')
        @include('frontend.services.inc.patient')
    @elseif ($title == 'doctor')
        @include('frontend.services.inc.doctor')
    @elseif ($title == 'hospital')
        @include('frontend.services.inc.hospital')
    @elseif ($title == 'e-prescription')
        @include('frontend.services.inc.e-prescription')
    @endif
@endsection
