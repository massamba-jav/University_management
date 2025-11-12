<x-layout>
  <div class="form-card">
    <a href="{{ route('professeurs.index') }}" class="back-btn">← Retour</a>

    <form action="{{ (isset($professeur) && $professeur->id) ? route('professeurs.update', $professeur->id) : route('professeurs.store') }}" method="POST" class="space-y-4">
      @csrf
      @if(isset($professeur) && $professeur->id) @method('PUT') @endif

      <h2 class="text-xl font-semibold text-gray-900">{{ (isset($professeur) && $professeur->id) ? 'Modifier Professeur' : 'Créer Professeur' }}</h2>

      <div>
        <label class="block text-sm font-medium text-gray-700">Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $professeur->nom ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Prénom</label>
        <input type="text" name="prenom" value="{{ old('prenom', $professeur->prenom ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Grade</label>
        <select name="grade" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
          @php $grades = ['Assistant','Maître','Maître de Conférences','Professeur']; $oldGrade = old('grade', $professeur->grade ?? ''); @endphp
          <option value="">Sélectionner</option>
          @foreach($grades as $g)
            <option value="{{ $g }}" {{ $g === $oldGrade ? 'selected' : '' }}>{{ $g }}</option>
          @endforeach
        </select>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-sm font-medium text-gray-700">Salaire</label>
          <input type="number" name="salaire" step="0.01" value="{{ old('salaire', $professeur->salaire ?? 0) }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Prime</label>
          <input type="number" name="prime" step="0.01" value="{{ old('prime', $professeur->prime ?? 0) }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required />
        </div>
      </div>

      @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-md p-3 text-sm">
          <ul class="list-disc ml-5">
            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
          </ul>
        </div>
      @endif

      <div class="form-actions">
        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white font-semibold">Enregistrer</button>
        <a href="{{ route('professeurs.index') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-gray-100 text-gray-800">Annuler</a>
      </div>
    </form>
  </div>
</x-layout>