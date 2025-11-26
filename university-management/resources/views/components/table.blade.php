<x-table :columns="$columns" :data="$data">
    <x-slot name="actions">
        <th style="text-align: right;">Actions</th>
    </x-slot>
    @foreach($data as $row)
        <tr data-id="{{ $row->id }}">
            @foreach($columns as $col)
                <td>{{ $row->$col ?? '' }}</td>
            @endforeach
            <td class="action-btns">
                <button class="btn-action btn-edit" onclick="handleEdit('{{ $type }}', '{{ $row->id }}')">✏️ Modifier</button>
                <button class="btn-action btn-delete" onclick="handleDelete('{{ $type }}', '{{ $row->id }}', this.closest('tr'))">🗑️ Supprimer</button>
            </td>
        </tr>
    @endforeach
</x-table>