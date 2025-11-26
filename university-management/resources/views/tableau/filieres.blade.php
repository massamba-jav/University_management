<x-layout>
    <main role="main" id="app-content">
        <h1>Filières</h1>

        <div class="btn-row" role="toolbar" aria-label="Choisir tableau">
            <a class="tbl-btn" href="{{ route('departements.index') }}">Département</a>
            <a class="tbl-btn" href="{{ route('professeurs.index') }}">Professeur</a>
            <a class="tbl-btn" href="{{ route('etudiants.index') }}">Étudiant</a>
        </div>

        <div class="table-wrapper" aria-live="polite">
            @if($filieres->isEmpty())
                <div class="table-placeholder">Aucune donnée disponible.</div>
            @else
                <x-table :columns="$columns" :data="$filieres" />
                <x-pagination :pagination="$pagination" />
            @endif
        </div>
    </main>
</x-layout>