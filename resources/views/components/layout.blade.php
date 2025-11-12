<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Université</title>

    {{-- CSS/JS via Vite --}}
    @vite(['resources/css/app.css', 'resources/css/tableau.css', 'resources/js/tableau.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <header class="bg-white border-b border-gray-200 shadow-sm">
        <nav class="max-w-7xl mx-auto px-6 py-4">
            <ul class="flex items-center gap-8">
                <li><a href="{{ url('/') }}" class="font-bold text-gray-900">Accueil</a></li>
                <li><a href="{{ route('filieres.index') }}" class="text-gray-700 hover:text-indigo-600">Filières</a></li>
                <li><a href="{{ route('departements.index') }}" class="text-gray-700 hover:text-indigo-600">Départements</a></li>
                <li><a href="{{ route('professeurs.index') }}" class="text-gray-700 hover:text-indigo-600">Professeurs</a></li>
                <li><a href="{{ route('etudiants.index') }}" class="text-gray-700 hover:text-indigo-600">Étudiants</a></li>
                <li><a href="{{ route('tableau') }}" class="text-gray-700 hover:text-indigo-600">Tableaux</a></li>
            </ul>
        </nav>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-8">
        {{ $slot }}
    </main>
</body>
</html>