<div>
    @push('header')
    <x-layouts.header title="List Akun" />
    @endpush

    <x-card shadow="shadow-sm" padding="px-0 py-4">
        <div class="flex justify-between px-4 pb-4 ">
            <div class="max-w-xs grow">
                <x-input placeholder="Cari akun.." wire:model.live.debounce="searchKeyword" />
                <div wire:loading wire:target='searchKeyword'>
                    <span class="text-xs text-gray-400">Mencari...</span>
                </div>
            </div>
        </div>

        @if (count($akuns) > 0)

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-primary-50">
                    <tr class="border-gray-200 border-y">
                        <th scope="col" class="w-10 px-6 py-3">
                            <span class="sr-only">No</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Kode Akun
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Nama Akun
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($akuns as $key => $akun)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                            {{ $akuns->firstItem() + $key }}
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap">
                            {{ $akun->kode }}
                        </td>
                        <td class="px-6 py-2 ">
                            {{ $akun->nama }}
                        </td>
                        <td class="flex justify-end gap-1 px-6 py-2">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-4 pt-4">
            {{ $akuns->onEachSide(1)->links() }}
        </div>

        @else

        <x-no-data title="Tidak ada data" />

        @endif

    </x-card>
</div>