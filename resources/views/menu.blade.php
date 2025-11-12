<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil — Université</title>
    @vite(['resources/css/app.css'])
    </head>
    <body class="antialiased bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <section class="menu-hero w-full max-w-5xl rounded-2xl overflow-hidden">
        <!-- background image: place your image at public/images/hero.jpg -->
        <div class="menu-hero__bg" style="background-image: url('{{ asset('images/hero.jpg') }}');" aria-hidden="true"></div>

        <!-- soft overlay for contrast -->
        <div class="menu-hero__overlay" aria-hidden="true"></div>

        <div class="menu-hero__content">
            <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">Portail de gestion universitaire</h1>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Consultez et administrez départements, filières, professeurs et étudiants. Interface réactive et tableaux dynamiques.</p>

            <div class="menu-hero__actions mt-8">
            <a href="{{ route('filieres.index') }}" class="btn inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white font-semibold hover:bg-indigo-700">Filières</a>
            <a href="{{ route('departements.index') }}" class="btn btn--ghost inline-flex items-center px-4 py-2 rounded-md">Départements</a>
            <a href="{{ route('professeurs.index') }}" class="btn btn--ghost inline-flex items-center px-4 py-2 rounded-md">Professeurs</a>
            <a href="{{ route('etudiants.index') }}" class="btn btn--ghost inline-flex items-center px-4 py-2 rounded-md">Étudiants</a>
            <a href="{{ route('tableau') }}" class="btn inline-flex items-center px-4 py-2 rounded-md border border-indigo-200 text-indigo-700">Tableaux dynamiques</a>
            </div>
        </div>
        </section>
    </div>
</body>
</html>