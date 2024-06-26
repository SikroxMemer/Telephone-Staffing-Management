@extends('layout')
<title>Gestion Du Puce</title>
@section('puce')

    <div class="p-5 sm:ml-64">
        @include('shared.success-message')
        @include('shared.warning-message')
        @include('shared.danger-message')

        <div class="p-4 drounded-lg  dark:border-gray-700" x>
        <h1 class="text-4xl text-black dark:text-white shadow-sm flex flex-row items-center">Ajouter Puce</h1>
        <br/>

        <form method="POST" action="{{route('puce.store')}}">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                @csrf
                @method('POST')
                <div>
                    <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Telephone
                    </label>
                    <input name="telephone" type="tel" id="observateur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   />
                </div>

                <div>

                    <label for="fourniseur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Fourniseur
                    </label>

                    <select name="fourniseur" id="fourniseur" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Maroc Telecome">Maroc Telecome</option>
                        <option value="Inwi">Inwi</option>
                        <option value="Orange">Orange</option>
                    </select>

                </div>

                <div>
                    <label for="fourniseur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Status
                    </label>
                    <div class="flex items-center mb-4">
                        <input id="active" type="radio" value="1" name="is_active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Activé</label>
                    </div>
                    <div class="flex items-center">
                        <input id="non-active" type="radio" value="0" name="is_active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-2"  class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Désactivé</label>
                    </div>
                </div>

                <div>
                    <label for="fourniseur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Type Puce
                    </label>
                    <div class="flex items-center mb-4">
                        <input id="vocale" type="radio" value="vocale" name="type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Vocale</label>
                    </div>
                    <div class="flex items-center">
                        <input id="internet" type="radio" value="internet" name="type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-2"  class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Internet</label>
                    </div>
                </div>
            </div>
        
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Ajouter
            </button>
        </form>
        </div>
        
    </div>
    

@endsection