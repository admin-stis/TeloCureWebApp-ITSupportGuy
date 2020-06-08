@extends('frontend.layouts.app')

@section('content')
    @if ($title == 'faq')
        @include('frontend.help.inc.faq')
    @elseif($title == 'howitworks')
    	@include('frontend.help.inc.how-helodoc-work')
    @endif
@endsection
