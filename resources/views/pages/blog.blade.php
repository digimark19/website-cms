@extends('layouts.app')

@section('content')


    <x-blog :search="request('search')" :limit="6" />
@endsection
