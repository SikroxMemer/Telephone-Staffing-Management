@extends('layout')
<title>Gestion Du Entité</title>
@section('entity')
    <div class="p-5 sm:ml-64">
        @include('shared.success-message')
        @include('shared.warning-message')
        @include('shared.danger-message')

        <div class="p-4 drounded-lg  dark:border-gray-700" x>
        <h1 class="text-4xl text-black dark:text-white flex flex-row items-center">Ajouter Entité</h1>
        <br/>

        <form method="POST" action="{{route('entity.store')}}">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                @csrf
                @method('POST')
                <div>
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nom
                    </label>
                    <input name="nom" type="tel" id="observateur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   />
                </div>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Ajouter
            </button>
        </form>
        </div>
    </div>
@endsection