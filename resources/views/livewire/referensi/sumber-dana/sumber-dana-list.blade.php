<div x-data="{
    open: $wire.entangle('form.formSumberDana').live,
    formAction: $wire.entangle('form.formAction').live,
    showConfirmDialog: $wire.entangle('showConfirmDialog').live
}" x-effect="console.log(showConfirmDialog)">
    @push('header')
        <x-layouts.header title="List Sumber Dana" />
    @endpush

    <x-card shadow="shadow-sm" padding="px-0 py-4">

        <div class="flex justify-between px-4 pb-4 ">
            <div class="max-w-xs grow">
                <x-input placeholder="Cari sumber dana.." wire:model.live.debounce="searchKeyword" />
                <div wire:loading wire:target='searchKeyword'>
                    <span class="text-xs text-gray-400">Mencari...</span>
                </div>
            </div>

            <div>
                <x-button primary x-on:click="() => {open = true; formAction = 'CREATE'}">
                    Tambah Sumber Dana
                </x-button>
            </div>
        </div>

        @if (count($sumberDanas) > 0)
            <div class="relative overflow-auto">
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
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sumberDanas as $key => $sumberDana)
                            <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $sumberDanas->firstItem() + $key }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $sumberDana->kode }}
                                </td>
                                <td class="px-6 py-2 ">
                                    [{{ $sumberDana->jenis }}] - {{ $sumberDana->nama }}
                                </td>

                                <td class="flex justify-end gap-1 px-6 py-2">
                                    <x-button.circle 2xs outline warning icon="pencil" wire:loading.attr="disabled"
                                        wire:loading.class="!cursor-wait"
                                        x-on:click="()=>{$wire.edit({{ $sumberDana }});open = true;}" />

                                    <x-button.circle 2xs outline negative icon="trash" wire:loading.attr="disabled"
                                        wire:loading.class="!cursor-wait" x-on:click="showConfirmDialog = true" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-4 pt-4">
                {{ $sumberDanas->links() }}
            </div>
        @else
            <x-no-data title="Tidak ada data">
                <x-button label="Tambah Sumber Dana" primary x-on:click="() => {open = true; formAction = 'CREATE'}" />
            </x-no-data>
        @endif

    </x-card>

    <x-modal.card title="Form Referensi Sumber Dana" wire:model="form.formSumberDana" x-on:close='open = false'>
        <p>{{ $form->formAction }}</p>

        <form wire:submit="save" class="space-y-3">
            <x-native-select label="Jenis Sumber Dana" placeholder="Pilih Jenis Sumber Dana" :options="['DANA UMUM', 'DANA KHUSUS']"
                wire:model="form.jenis" />
            <x-input label="Kode Sumber Dana" placeholder="1.01.xxx" wire:model="form.kode" />
            <x-input label="Nama Sumber Dana" placeholder="Belanja XYZ" wire:model="form.nama" />

            <div class="flex justify-between pt-4 border-t">
                <x-button type="button" outline secondary x-on:click="close">Batal</x-button>
                <x-button primary type="submit">Simpan</x-button>
            </div>

        </form>
    </x-modal.card>

    <div>
        @if ($showConfirmDialog)
            <span>TRUE</span>
        @else
            <span>FALSE</span>
        @endif
    </div>

    <x-modal blur align="center" wire:model="showConfirmDialog"
        x-on:close='()=>{showConfirmDialog=false; console.log(showConfirmDialog)}'>
        <div
            class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Deactivate
                            account</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Are you sure you want to deactivate your account? All
                                of your data will be permanently removed. This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button"
                    class="inline-flex justify-center w-full px-3 py-2 text-sm font-semibold text-white bg-red-600 rounded-md shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Deactivate</button>
                <button type="button" x-on:click="showConfirmDialog = false"
                    class="inline-flex justify-center w-full px-3 py-2 mt-3 text-sm font-semibold text-gray-900 bg-white rounded-md shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
            </div>
        </div>
    </x-modal>

</div>

@push('scripts')
    <script></script>
@endpush
