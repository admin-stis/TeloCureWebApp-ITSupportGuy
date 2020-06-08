@extends('frontend.layouts.app')

@section('content')
    @if ($title == 'patient')
        @include('frontend.help.inc.patient')
    @elseif ($title == 'doctor')
        @include('frontend.help.inc.doctor')
    @elseif ($title == 'hospital')
        @include('frontend.help.inc.hospital')
    @endif
@endsection
