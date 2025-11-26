<x-layout>
  <div class="form-card">
    <a href="{{ route('departements.index') }}" class="back-btn">← Retour</a>

    <form action="{{ (isset($departement) && $departement->id) ? route('departements.update', $departement->id) : route('departements.store') }}" method="POST" class="space-y-4">
      @csrf
      @if(isset($departement) && $departement->id) @method('PUT') @endif

      <h2 class="text-xl font-semibold text-gray-900">{{ (isset($departement) && $departement->id) ? 'Modifier Département' : 'Créer Département' }}</h2>

      <div>
        <label class="block text-sm font-medium text-gray-700">Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $departement->nom ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Capacité (heures)</label>
        <input type="number" name="capacite" value="{{ old('capacite', $departement->capacite ?? 0) }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" />
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