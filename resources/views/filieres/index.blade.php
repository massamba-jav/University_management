<x-layout>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Filières</h2>
        <a href="{{ route('filieres.create') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white font-semibold hover:bg-indigo-700">+ Créer</a>
    </div>

    <ul class="space-y-3">
        @foreach($filieres as $filiere)
            <li>
                <x-card href="{{ route('filieres.show', $filiere->id) }}">
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $filiere->nom }}</h3>
                        <p class="text-sm text-gray-600">Département: {{ $filiere->departement->nom ?? '—' }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>

    <div class="mt-8">
        {{ $filieres->links() }}
    </div>
</x-layout>