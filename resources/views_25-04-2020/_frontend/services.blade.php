@extends('frontend.layouts.app')

@section('content')
    @if ($title == 'patient')
        @include('frontend.services.service-patient')
    @elseif ($title == 'doctor')
        @include('frontend.services.service-doctor')
    @elseif ($title == 'hospital')
        @include('frontend.services.service-hospital')
    @elseif ($title == 'e-prescription')
        @include('frontend.services.service-prescription')
    @endif
@endsection
