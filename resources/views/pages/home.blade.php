@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <!-- Hero Section -->
    @include('components.hero')

    <!-- Pourquoi H.I.T Section -->
    @include('components.why-hit')

    <!-- Initiative Gouvernementale -->
    @include('components.initiative')

    <!-- Partenaires -->
    @include('components.partners')

    <!-- Services -->
    @include('components.services')

    <!-- Actualités -->
    @include('components.news')

    <!-- Newsletter -->
    @include('components.newsletter')
@endsection 