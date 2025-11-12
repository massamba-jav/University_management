<x-layout>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Départements</h2>
        <a href="{{ route('departements.create') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white font-semibold hover:bg-indigo-700">+ Créer</a>
    </div>

    <ul class="space-y-3">
        @foreach($departements as $departement)
            <li>
                <x-card href="{{ route('departements.show', $departement->id) }}">
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $departement->nom }}</h3>
                        <p class="text-sm text-gray-600">Capacité: {{ $departement->capacite }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>

    <div class="mt-8">
        {{ $departements->links() }}
    </div>
</x-layout>