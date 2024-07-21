<div class="mb-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <tbody>
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        SKPD
                    </th>
                    <td class="px-4 py-2 w-4">
                        :
                    </td>
                    <td class="px-4 py-2">
                        {{ $unitSkpd->skpd->kode." ".$unitSkpd->skpd->nama }}
                    </td>
                </tr>
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Unit SKPD
                    </th>
                    <td class="px-4 py-2 w-4">
                        :
                    </td>
                    <td class="px-4 py-2">
                        {{ $unitSkpd->kode." ".$unitSkpd->nama }}
                    </td>
                </tr>
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Bidang Urusan
                    </th>
                    <td class="px-4 py-2 w-4">
                        :
                    </td>
                    <td class="px-4 py-2">
                        {{ $subKegiatan->kegiatan->program->bidangUrusan->nama }}
                    </td>
                </tr>
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Program
                    </th>
                    <td class="px-4 py-2 w-4">
                        :
                    </td>
                    <td class="px-4 py-2">
                        {{ $subKegiatan->kegiatan->program->nama }}
                    </td>
                </tr>
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Kegiatan
                    </th>
                    <td class="px-4 py-2 w-4">
                        :
                    </td>
                    <td class="px-4 py-2">
                        {{ $subKegiatan->kegiatan->nama }}
                    </td>
                </tr>
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Sub Kegiatan
                    </th>
                    <td class="px-4 py-2 w-4">
                        :
                    </td>
                    <td class="px-4 py-2">
                        {{ $subKegiatan->nama }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>