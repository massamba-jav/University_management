<x-layout>
    <main role="main" id="app-content">
        <h1>Menu Principal</h1>

        <div class="btn-row" role="toolbar" aria-label="Navigation">
            <a class="btn" href="{{ route('etudiants.index') }}">Gérer Étudiants</a>
            <a class="btn" href="{{ route('filieres.index') }}">Gérer Filières</a>
            <a class="btn" href="{{ route('departements.index') }}">Gérer Départements</a>
            <a class="btn" href="{{ route('professeurs.index') }}">Gérer Professeurs</a>
            <a class="btn" href="{{ route('tableau') }}">Afficher Tableau</a>
        </div>
    </main>
</x-layout>