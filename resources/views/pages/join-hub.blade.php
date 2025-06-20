@extends('layouts.app')

@section('title', $pageTitle)
@section('meta_description', $metaDescription)

@section('content')
    <br><br>
    @include('components.join-hub')
@endsection
