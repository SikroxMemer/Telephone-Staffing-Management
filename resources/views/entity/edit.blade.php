@extends('layout')
<title>Gestion Du Entité</title>
@section('entity')
<div class="p-5 sm:ml-64">
    @include('shared.success-message')
    @include('shared.warning-message')
    @include('shared.danger-message')

    <div class="p-4 drounded-lg  dark:border-gray-700" x>
        <h1 class="text-4xl text-black dark:text-white flex flex-row items-center">Modifier Entité</h1>

        <br />

        <form method="POST" action="{{route('entity.update' , ['entity' => $entity->id])}}">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                @csrf
                @method('PUT')
                <div>
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nom
                    </label>
                    <input required name="nom" value="{{$entity->nom}}" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
            </div>
            <div class="flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input required name="check" id="check" type="checkbox"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" />
                </div>
                <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirmer la
                    modification</label>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Modifier
            </button>
        </form>
    </div>
</div>
@endsection