<x-layout>
  <div class="max-w-3xl mx-auto">
    <a href="{{ route('etudiants.index') }}" class="back-btn">← Retour</a>

    <h2 class="text-xl font-semibold mb-3">Étudiant</h2>

    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm mb-4">
      <p><strong>Nom :</strong> {{ $etudiant->nom }}</p>
      <p><strong>Prénom :</strong> {{ $etudiant->prenom }}</p>
      <p><strong>Date de naissance :</strong> {{ $etudiant->date_naissance }}</p>
      <p><strong>Lieu de naissance :</strong> {{ $etudiant->lieu_naissance }}</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm mb-4">
      <h3 class="font-semibold mb-2">Filière</h3>
      <p><strong>Nom :</strong> {{ $etudiant->filiere->nom ?? '—' }}</p>
      <p><strong>Droit d'inscription :</strong> {{ $etudiant->filiere->droit_inscription ?? '—' }}</p>
    </div>

    <div class="flex gap-3">
      <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white">Modifier</a>
      <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
        @csrf @method('DELETE')
        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-md bg-red-600 text-white">Supprimer</button>
      </form>
    </div>
  </div>
</x-layout>