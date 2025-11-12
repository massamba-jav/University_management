<x-layout>
  <div class="max-w-3xl mx-auto">
    <a href="{{ route('filieres.index') }}" class="back-btn">← Retour</a>

    <h2 class="text-xl font-semibold mb-3">Filière</h2>

    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm mb-4">
      <p><strong>Nom :</strong> {{ $filiere->nom }}</p>
      <p><strong>Droit d'inscription :</strong> {{ $filiere->droit_inscription }}</p>
      <p><strong>Mensualité :</strong> {{ $filiere->mensualite }}</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm mb-4">
      <h3 class="font-semibold mb-2">Département</h3>
      <p><strong>Nom :</strong> {{ $filiere->departement->nom ?? '—' }}</p>
      <p><strong>Capacité :</strong> {{ $filiere->departement->capacite ?? '—' }}</p>
    </div>

    <div class="flex gap-3">
      <a href="{{ route('filieres.edit', $filiere->id) }}" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white">Modifier</a>
      <form action="{{ route('filieres.destroy', $filiere->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
        @csrf @method('DELETE')
        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-md bg-red-600 text-white">Supprimer</button>
      </form>
    </div>
  </div>
</x-layout>