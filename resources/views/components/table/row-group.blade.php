@props(['value', 'colspan' => 0, 'padding'=>'px-6 py-2'])

<tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
    <td class="{{ $padding }} whitespace-nowrap"></td>
    <td class="{{ $padding }} whitespace-nowrap font-semibold" colspan="{{ $colspan }}">
        {{ $value }}
    </td>
</tr>