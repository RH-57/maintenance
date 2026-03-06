<table class="w-full border border-gray-300 text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="border px-3 py-2 text-left">Checklist</th>
            <th class="border px-3 py-2 text-center">Result</th>
            <th class="border px-3 py-2 text-left">Remark</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($get('checklists') ?? [] as $index => $row)

        <tr>

            <td class="border px-3 py-2">
                {{ $row['item_name'] }}
            </td>

            <td class="border px-3 py-2 text-center">

                <label>
                    <input type="radio"
                        wire:model="data.checklists.{{ $index }}.result"
                        value="OK">
                    OK
                </label>

                <label class="ml-3">
                    <input type="radio"
                        wire:model="data.checklists.{{ $index }}.result"
                        value="NG">
                    Problem
                </label>

                <label class="ml-3">
                    <input type="radio"
                        wire:model="data.checklists.{{ $index }}.result"
                        value="NA">
                    N/A
                </label>

            </td>

            <td class="border px-3 py-2">

                <input type="text"
                    class="w-full border-gray-300 rounded"
                    wire:model="data.checklists.{{ $index }}.remark">

            </td>

        </tr>

        @endforeach

    </tbody>
</table>
