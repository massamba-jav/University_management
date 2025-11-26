<x-layout>
    <main role="main" id="app-content">
        <h1>Professeurs</h1>

        <div class="btn-row" role="toolbar" aria-label="Choisir tableau">
            <a class="tbl-btn" href="{{ route('professeurs.create') }}">Ajouter Professeur</a>
        </div>

        <div id="table-container" class="table-wrapper">
            @if($professeurs->isEmpty())
                <div class="table-placeholder">Aucun professeur trouvé.</div>
            @else
                <x-table :columns="['Nom', 'Prénom', 'Email', 'Actions']">
                    @foreach($professeurs as $professeur)
                        <tr>
                            <td>{{ $professeur->nom }}</td>
                            <td>{{ $professeur->prenom }}</td>
                            <td>{{ $professeur->email }}</td>
                            <td class="action-btns">
                                <a class="btn-action btn-edit" href="{{ route('professeurs.edit', $professeur->id) }}">✏️ Modifier</a>
                                <form action="{{ route('professeurs.destroy', $professeur->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Voulez-vous vraiment supprimer cet enregistrement ? Cette action est irréversible.');">🗑️ Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            @endif
        </div>

        <div class="pagination">
            {{ $professeurs->links() }}
        </div>
    </main>
</x-layout>