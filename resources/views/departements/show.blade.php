<x-layout>
  <div class="max-w-3xl mx-auto">
    <a href="{{ route('departements.index') }}" class="back-btn">← Retour</a>

    <h2 class="text-xl font-semibold mb-3">Département</h2>

    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm mb-4">
      <p><strong>Nom :</strong> {{ $departement->nom }}</p>
      <p><strong>Capacité :</strong> {{ $departement->capacite }} h</p>
    </div>

    <div class="flex gap-3">
      <a href="{{ route('departements.edit', $departement->id) }}" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white">Modifier</a>
      <form action="{{ route('departements.destroy', $departement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
        @csrf @method('DELETE')
        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-md bg-red-600 text-white">Supprimer</button>
      </form>
    </div>
  </div>
</x-layout>