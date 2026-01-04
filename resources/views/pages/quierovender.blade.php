@extends('layouts.app')

@section('title', "propiedades")

@section('content')
<div>
    <!-- Be present above all else. - Naval Ravikant -->
    <!-- Hero removed for modern cleaner look -->
    <x-hero-vender />

    <x-venta-inmueble />

    <x-porque-vender-inmueble />

    <x-procesoVenta />

    <x-formularioOne tipo="vender"/>
</div>
@endsection
