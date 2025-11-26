<x-layout>
  <div class="form-card">
    <a href="{{ route('filieres.index') }}" class="back-btn">← Retour</a>

    <form action="{{ (isset($filiere) && $filiere->id) ? route('filieres.update', $filiere->id) : route('filieres.store') }}" method="POST" class="space-y-4">
      @csrf
      @if(isset($filiere) && $filiere->id) @method('PUT') @endif

      <h2 class="text-xl font-semibold text-gray-900">{{ (isset($filiere) && $filiere->id) ? 'Modifier Filière' : 'Créer Filière' }}</h2>

      <div>
        <label class="block text-sm font-medium text-gray-700">Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $filiere->nom ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" />
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-sm font-medium text-gray-700">Droit d'inscription</label>
          <input type="number" name="droit_inscription" step="0.01" value="{{ old('droit_inscription', $filiere->droit_inscription ?? 0) }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Mensualité</label>
          <input type="number" name="mensualite" step="0.01" value="{{ old('mensualite', $filiere->mensualite ?? 0) }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" />
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Département</label>
        <select name="departement_id" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
          <option value="">Sélectionner</option>
          @foreach($departements as $d)<option value="{{ $d->id }}" {{ (string)$d->id === (string)old('departement_id', $filiere->departement_id ?? '') ? 'selected' : '' }}>{{ $d->nom }}</option>@endforeach
        </select>
      </div>

      @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-md p-3 text-sm">
          <ul class="list-disc ml-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
      @endif

      <div class="form-actions">
        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white font-semibold">Enregistrer</button>
        <a href="{{ route('back') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-gray-100 text-gray-800">Annuler</a>
      </div>
    </form>
  </div>
</x-layout>