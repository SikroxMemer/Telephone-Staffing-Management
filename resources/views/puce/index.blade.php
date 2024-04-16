@extends('layout')
<title>Gestion Du Puce</title>
@section('puce')
    <div class="p-5 sm:ml-64">
        @include('shared.success-message')
        @include('shared.warning-message')
        @include('shared.danger-message')
        <div class="p-4 drounded-lg  dark:border-gray-700" x>
        <h1 class="text-4xl text-black dark:text-white">Gestion Du Puce</h1>
        <br/>
            <livewire:pucetable/>
            <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{route('puce.create')}}">
                Ajouter Puce
            </a>
        </div>
    </div>
@endsection