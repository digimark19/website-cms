@extends('layouts.app')

@section('title', "Contacto")

@section('content')
<div>
    
    <x-hero />
    <!-- Be present above all else. - Naval Ravikant -->
    <x-contact-form tipo="contacto" />
    
    <x-mapa />

</div>
@endsection
