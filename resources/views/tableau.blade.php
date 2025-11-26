<x-layout>
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
                    <option value="{{ $pp }}" {{ (int) request('per_page', 10) === $pp ? 'selected' : '' }}>{{ $pp }}</option>
                @endforeach
            </select>
        </form>
    </div>

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
                </tr>
            </thead>
            <tbody>
                @forelse($items as $row)
                    <tr @if(mt_rand(1, 10) <= 3) class="highlight" @endif>
                        @foreach($columns as $col)
                            <td>{{ data_get($row, $col) }}</td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ max(1, count($columns)) }}" class="no-data">Aucune donnée</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination my-3">
            {{ $items->links() }}
        </div>
    </div>

</div>
</x-layout>