@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ __('messages.welcome') }}</h1>
    <p>{{ __('messages.dashboard') }}👋</p>
@endsection
