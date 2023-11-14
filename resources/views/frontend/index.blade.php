@extends('frontend.layouts.master')

@push("css")
    
@endpush

@section('content') 

@include('frontend.sections.banner')


@include('frontend.sections.security')


@include('frontend.sections.download-app')

@include('frontend.sections.statistics')

@include('frontend.sections.contact')
@endsection


@push("script")
    
@endpush