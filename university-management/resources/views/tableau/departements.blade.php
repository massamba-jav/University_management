<x-layout>
    <main role="main" id="app-content">
        <h1>Départements</h1>

        <div class="btn-row" role="toolbar" aria-label="Choisir tableau">
            <a href="{{ route('departements.create') }}" class="tbl-btn">Ajouter Département</a>
        </div>

        <div id="table-container" class="table-wrapper">
            @if($departements->isEmpty())
                <div class="table-placeholder">Aucun département trouvé.</div>
            @else
                <x-table :columns="['ID', 'Nom', 'Actions']">
                    @foreach($departements as $departement)
                        <tr>
                            <td>{{ $departement->id }}</td>
                            <td>{{ $departement->nom }}</td>
                            <td class="action-btns">
                                <a href="{{ route('departements.edit', $departement) }}" class="btn-action btn-edit">✏️ Modifier</a>
                                <form action="{{ route('departements.destroy', $departement) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">🗑️ Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-table>

                <x-pagination :pagination="$departements" />
            @endif
        </div>
    </main>
</x-layout>