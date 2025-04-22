@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('sections.hero')
    @include('sections.about')
    @include('sections.why')
    @include('sections.product')
    @include('sections.payment')
@endsection
