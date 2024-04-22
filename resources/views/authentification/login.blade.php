<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{url('/crud.svg')}}" type="image/x-icon">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>

<body class="bg-slate-100">
    <section class="h-screen flex items-center justify-center  flex-col">
        @include('shared.danger-message')
        <img src="{{url('/Logo.jpg')}}" class="rounded-lg w-[5%] mb-5" alt=""/>
        <form class="w-full max-w-sm" action="{{route('login.post')}}" method="POST">
            @csrf
            @method("POST")

            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                        Nom Utilisateur
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        id="inline-full-name" name="username" type="text" placeholder="Username">
                </div>
            </div>

            
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                        Mot de passe

                    </label>
                </div>
                <div class="md:w-2/3">
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        id="inline-password" name="password" type="password" placeholder="******************">
                </div>
            </div>

            <div class="md:flex md:items-center lg:flex justify-between">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button
                        class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                        type="submit">
                        Se connecter
                    </button>
                    <a href="{{route('register')}}" class="text-blue-400 underline font-bold ml-10">S'inscrire</a>
                </div>
            </div>
        </form>
    </section>
</body>

</html>