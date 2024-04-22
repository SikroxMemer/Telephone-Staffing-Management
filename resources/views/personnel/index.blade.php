@extends('layout')
<title>Gestion Du Personnel</title>
@section('dotation')
    <div class="p-5 sm:ml-64">
        
        @include('shared.success-message')
        @include('shared.warning-message')
        @include('shared.danger-message')
        <div class="p-4 drounded-lg">
        <h1 class="text-4xl text-black dark:text-white">Gestion Du Personnel</h1>
        <br/>
            <livewire:personneltable/>
            <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{route('personnel.create')}}">
                Ajouter Personnel
            </a>
        </div>
    </div>
@endsection