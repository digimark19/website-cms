@extends('layouts.app')

@section('content')

    <x-hero />

    <x-blog :search="request('search')" :limit="6" />
@endsection
