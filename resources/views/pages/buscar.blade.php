@extends('layouts.app')

@section('title', 'Buscar Propiedades')

@section('content')

    {{-- Componente de búsqueda con resultados --}}
    <div class="lg:px-8 max-w-7xl mx-auto px-4 sm:px-6">
        <x-propiedades-grid />
    </div>

@endsection
