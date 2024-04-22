@extends('layout')
<title>Gestion Du Puce</title>
@section('personnel')

<div class="p-5 sm:ml-64">
    @include('shared.success-message')
    @include('shared.warning-message')
    @include('shared.danger-message')

    <div class="p-4 drounded-lg  dark:border-gray-700" x>
        <h1 class="text-4xl text-black dark:text-white shadow-sm flex flex-row items-center">Modifier Personnel</h1>
        <br />

        <form method="post" action="{{route('personnel.update' , ['personnel' => $personnel->id])}}">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                @csrf
                @method('PUT')
                <div>
                    <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nom
                    </label>
                    <input required name="nom" type="text" value="{{$personnel->nom}}" id="observateur"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Prénom
                    </label>
                    <input required name="prenom" type="text" value="{{$personnel->prenom}}" id="observateur"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="matricule" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Matricule
                    </label>
                    <input required name="matricule" type="text" value="{{$personnel->matricule}}" id="observateur"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="entity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Entité
                    </label>
                    <select required name="entity" id="entity"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($entity as $item)
                        <option value="{{$item->id}}">{{$item->nom}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                        <input required name="check" id="check" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" />
                    </div>
                    <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirmer la
                        modification</label>
                </div>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Modifier
            </button>
        </form>
    </div>
</div>
@endsection