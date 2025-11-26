<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <main role="main" id="app-content">
        <h1>Tableaux</h1>

        <div class="btn-row" role="toolbar" aria-label="Choisir tableau">
            <a href="{{ route('departements.index') }}" class="tbl-btn">Département</a>
            <a href="{{ route('filieres.index') }}" class="tbl-btn">Filière</a>
            <a href="{{ route('professeurs.index') }}" class="tbl-btn">Professeur</a>
            <a href="{{ route('etudiants.index') }}" class="tbl-btn">Étudiant</a>
        </div>

        <div id="table-container" class="table-wrapper">
            @if($data->isEmpty())
                <div class="table-placeholder">Aucun tableau sélectionné. Cliquez sur un bouton pour afficher les données.</div>
            @else
                <x-table :columns="$columns" :data="$data" />
                <x-pagination :pagination="$pagination" />
            @endif
        </div>
    </main>
</x-layout>