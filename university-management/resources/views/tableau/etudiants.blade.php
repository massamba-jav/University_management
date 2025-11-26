<x-layout>
    <main role="main" id="app-content">
        <h1>Étudiants</h1>

        <div class="btn-row" role="toolbar" aria-label="Choisir tableau">
            <a class="tbl-btn" href="{{ route('departements.index') }}">Département</a>
            <a class="tbl-btn" href="{{ route('filieres.index') }}">Filière</a>
            <a class="tbl-btn" href="{{ route('professeurs.index') }}">Professeur</a>
            <a class="tbl-btn" href="{{ route('etudiants.index') }}">Étudiant</a>
        </div>

        @if($etudiants->isEmpty())
            <div class="table-placeholder">Aucune donnée disponible.</div>
        @else
            <x-table :columns="['ID', 'Nom', 'Prénom', 'Email', 'Actions']">
                @foreach($etudiants as $etudiant)
                    <tr>
                        <td>{{ $etudiant->id }}</td>
                        <td>{{ $etudiant->nom }}</td>
                        <td>{{ $etudiant->prenom }}</td>
                        <td>{{ $etudiant->email }}</td>
                        <td class="action-btns">
                            <a class="btn-action btn-edit" href="{{ route('etudiants.edit', $etudiant->id) }}">✏️ Modifier</a>
                            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">🗑️ Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-table>

            <x-pagination :pagination="$etudiants" />
        @endif
    </main>
</x-layout>