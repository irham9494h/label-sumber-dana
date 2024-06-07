<div>
    @push('header')
        <x-layouts.header title="List Data SKPD" />
    @endpush

    <x-card shadow="shadow-sm" padding="px-0 py-4">
        <div class="flex justify-end px-4 pb-4 ">
            <x-button primary href="" wire:navigate>Tambah SKPD</x-button>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-primary-50">
                    <tr class="border-gray-200 border-y">
                        <th scope="col" class="w-10 px-6 py-3">
                            <span class="sr-only">No</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Kode
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Nama SKPD
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Nama Kepala
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            NIP
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </x-card>
</div>
