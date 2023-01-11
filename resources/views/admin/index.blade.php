@extends('adminlte::page')

@section('content_header')
    <h1>Panel administrador</h1>
@stop

@section('content')
<x-app-layout>
    @livewire('admin.admin-horario')
</x-app-layout>
@stop
