<x-layout>
  <div class="form-card">
    <a href="{{ route('etudiants.index') }}" class="back-btn">← Retour</a>

    <form action="{{ (isset($etudiant) && $etudiant->id) ? route('etudiants.update', $etudiant->id) : route('etudiants.store') }}" method="POST" class="space-y-4">
      @csrf
      @if(isset($etudiant) && $etudiant->id) @method('PUT') @endif

      <h2 class="text-xl font-semibold text-gray-900">{{ (isset($etudiant) && $etudiant->id) ? 'Modifier Étudiant' : 'Inscrire Étudiant' }}</h2>

      <div>
        <label class="block text-sm font-medium text-gray-700">Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $etudiant->nom ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Prénom</label>
        <input type="text" name="prenom" value="{{ old('prenom', $etudiant->prenom ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" />
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-sm font-medium text-gray-700">Date de naissance</label>
          <input type="date" name="date_naissance" value="{{ old('date_naissance', $etudiant->date_naissance ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Lieu de naissance</label>
          <input type="text" name="lieu_naissance" value="{{ old('lieu_naissance', $etudiant->lieu_naissance ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" />
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Filière</label>
        <select name="filiere_id" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
          <option value="">Sélectionner</option>
          @foreach($filieres as $f)<option value="{{ $f->id }}" {{ (string)$f->id === (string)old('filiere_id', $etudiant->filiere_id ?? '') ? 'selected' : '' }}>{{ $f->nom }}</option>@endforeach
        </select>
      </div>

      @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-md p-3 text-sm">
          <ul class="list-disc ml-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
      @endif

      <div class="form-actions">
        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white font-semibold">Enregistrer</button>
        <a href="{{ route('etudiants.index') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-gray-100 text-gray-800">Annuler</a>
      </div>
    </form>
  </div>
</x-layout>