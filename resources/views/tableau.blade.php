<x-layout>
    <div class="container">
        <div class="container">

            <div class="table-heading">
                <h2>{{ ucfirst($type) }}</h2>
            </div>

            <div class="tbl-controls mb-3">
                <div class="btn-group">
                    <a class="btn btn-outline-primary {{ $type === 'etudiants' ? 'active' : '' }}"
                        href="{{ route('tables.index', ['type' => 'etudiants']) }}">Etudiants</a>
                    <a class="btn btn-outline-primary {{ $type === 'professeurs' ? 'active' : '' }}"
                        href="{{ route('tables.index', ['type' => 'professeurs']) }}">Professeurs</a>
                    <a class="btn btn-outline-primary {{ $type === 'filieres' ? 'active' : '' }}"
                        href="{{ route('tables.index', ['type' => 'filieres']) }}">Filières</a>
                    <a class="btn btn-outline-primary {{ $type === 'departements' ? 'active' : '' }}"
                        href="{{ route('tables.index', ['type' => 'departements']) }}">Départements</a>
                </div>

                <form method="get" action="{{ route('tables.index') }}" class="d-inline-block ms-3">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <label class="me-2">Par page:</label>
                    <select name="per_page" onchange="this.form.submit()">
                        @foreach([10, 25, 50, 100] as $pp)
                            <option value="{{ $pp }}" {{ (int) request('per_page', 10) === $pp ? 'selected' : '' }}>{{ $pp }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            @php
                // Map type (français) -> [nom de la ressource (fr), clé param (singulier)]
                $routeConfig = [
                    'etudiants' => ['name' => 'etudiants', 'param' => 'etudiant'],
                    'professeurs' => ['name' => 'professeurs', 'param' => 'professeur'],
                    'filieres' => ['name' => 'filieres', 'param' => 'filiere'],
                    'departements' => ['name' => 'departements', 'param' => 'departement'],
                ];
                $r = $routeConfig[$type] ?? $routeConfig['etudiants'];
            @endphp

            <div id="table-container">
                <table class="table table-striped tbl">
                    <thead>
                        <tr>
                            @foreach($columns as $col)
                                <th>
                                    {{ $col }}
                                    @php
    $isCurrent = request('sort') === $col;
    $dir = request('dir', 'asc');
    $nextDir = $isCurrent && $dir === 'asc' ? 'desc' : 'asc';
                                    @endphp
                                    <a href="{{ route('tables.index', array_merge(request()->query(), ['type' => $type, 'sort' => $col, 'dir' => $nextDir])) }}"
                                        class="ms-1 small">
                                        @if($isCurrent)
                                            {{ $dir === 'asc' ? '↑' : '↓' }}
                                        @else
                                            ↕
                                        @endif
                                    </a>
                                </th>
                            @endforeach
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $row)
                            <tr @if(mt_rand(1, 10) <= 3) class="highlight" @endif>
                                @foreach($columns as $col)
                                    <td>{{ data_get($row, $col) }}</td>
                                @endforeach
                                <td class="actions">
                                    <a class="btn btn-sm btn-warning me-2"
                                        href="{{ route($r['name'] . '.edit', [$r['param'] => $row->id]) }}">
                                        Modifier
                                    </a>
                                    <form method="POST"
                                        action="{{ route($r['name'] . '.destroy', [$r['param'] => $row->id]) }}"
                                        class="d-inline" onsubmit="return confirm('Confirmer la suppression ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ max(1, count($columns) + 1) }}" class="no-data">Aucune donnée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination my-3">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>