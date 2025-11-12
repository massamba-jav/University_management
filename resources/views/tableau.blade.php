<x-layout>
    <main role="main" id="app-content">
        <h1>Tableaux</h1>

        <div class="btn-row" role="toolbar" aria-label="Choisir tableau">
            <button class="tbl-btn" data-type="departements">Département</button>
            <button class="tbl-btn" data-type="filieres">Filière</button>
            <button class="tbl-btn" data-type="professeurs">Professeur</button>
            <button class="tbl-btn" data-type="etudiants">Étudiant</button>
        </div>

        <div id="loader" class="hidden text-center py-4" aria-live="polite" aria-busy="false">
            <div class="spinner" role="status" aria-hidden="true"></div>
            <div class="loader-text">Chargement...</div>
        </div>

        <div id="table-container" class="table-wrapper empty" aria-live="polite">
            <div class="table-placeholder">Aucun tableau sélectionné. Cliquez sur un bouton pour afficher les données.</div>
        </div>
    </main>
</x-layout>