<x-layout>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Professeurs</h2>
        <a href="{{ route('professeurs.create') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white font-semibold hover:bg-indigo-700">+ Créer</a>
    </div>

    <ul class="space-y-3">
        @foreach($professeurs as $professeur)
            <li>
                <x-card href="{{ route('professeurs.show', $professeur->id) }}">
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $professeur->nom }} {{ $professeur->prenom }}</h3>
                        <p class="text-sm text-gray-600">{{ $professeur->grade }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>

    <div class="mt-8">
        {{ $professeurs->links() }}
    </div>
</x-layout>