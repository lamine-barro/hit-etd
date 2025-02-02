@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <!-- Hero Section -->
    @include('components.hero')

    <!-- Pourquoi H.I.T Section -->
    @include('components.why-hit')

    <!-- Services -->
    @include('components.services')

    <!-- Initiative Gouvernementale -->
    @include('components.initiative')

    <!-- Campus -->
    @include('components.campus')

    <!-- Actualités -->
    @include('components.news')

    <!-- Partenaires -->
    @include('components.partners')

    <!-- FAQ -->
    @include('components.faq')

    <!-- Newsletter -->
    @include('components.newsletter')
@endsection 