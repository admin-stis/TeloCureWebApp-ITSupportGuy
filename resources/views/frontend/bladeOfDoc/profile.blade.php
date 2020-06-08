@extends('frontend.layouts.app')

@section('content')
    @if ($title == 'about')
        @include('frontend.profile.inc.about-us')
    @elseif ($title == 'workingprocess')
        @include('frontend.profile.inc.how-it-works')
    @elseif ($title == 'investor')
        @include('frontend.profile.inc.investors')
    @endif
@endsection
