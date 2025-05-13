<x-layout>
  <x-navigate.sidebar></x-navigate.sidebar>
    
    @if (session()->has('success'))
    <div id="toast-success" class="ml-75 mt-5 flex items-center w-full max-w-xs p-4 text-white bg-[#0D0D0D] rounded-lg shadow" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal text-white">{{ session('success') }}</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[#A6FF00] text-[#0D0D0D] hover:bg-[#AEFF76] rounded-lg focus:ring-2 focus:ring-[#A6FF00] p-1.5 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    @endif
    @if (session()->has('error'))
    <div id="toast-warning" class="ml-75 mt-5 flex items-center w-full max-w-xs p-4 text-white bg-[#0D0D0D] rounded-lg shadow" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
            </svg>
            <span class="sr-only">Warning icon</span>
        </div>
        <div class="ms-3 text-sm font-normal text-white">{{ session('error') }}</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[#A6FF00] text-[#0D0D0D] hover:bg-[#AEFF76] rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    @endif
    <div class="relative overflow-x-auto pl-68 mx-5 pt-10">
    <table class="w-full text-sm text-left rtl:text-right text-[#111827]">
        <div class="flex justify-between p-5 text-xl font-semibold text-left rtl:text-right text-white bg-[#1E1E1E]">
        <span>Alternatif</span>
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="gap-2 text-[#111827] bg-[#A6FF00] hover:bg-[#AEFF76] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1.5 text-center inline-flex items-center me-2">
            <svg class="w-4 h-4 text-[#111827]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="2" height="2" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            Tambah Alternatif
            </button>
        </div>
        <thead class="text-xs text-center text-gray-700 uppercase bg-[#0D0D0D] dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Kode
                </th>
                <th scope="col" class="px-6 py-3">
                    Alternatif
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="text-white">
            @forelse ($alternatif as $item)
            <tr class="bg-[#1E1E1E] border-b border-[#0D0D0D] text-center">
                <td class="px-6 py-4">
                    {{ $loop->iteration }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->kode_alternatif }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->nama_alternatif }}
                </td>
                <td class="px-6 py-4">
                    <button data-modal-target="edit-modal-{{ $item->id }}" data-modal-toggle="edit-modal-{{ $item->id }}" type="button"><svg class="w-6 h-6 text-[#A4FC00] cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                    </svg>
                    </button>
                    <button data-modal-target="popup-modal-{{ $item->id }}" data-modal-toggle="popup-modal-{{ $item->id }}" type="button"><svg class="w-6 h-6 text-[#A4FC00] cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    </button>
                </td>
            </tr>
            {{-- Popup Delete --}}
            <div id="popup-modal-{{ $item->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-[#0D0D0D] rounded-lg shadow">
                        <button type="button" class="absolute top-3 end-2.5 text-white bg-transparent hover:bg-[#A4FC00] hover:text-[#0D0D0D] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-{{ $item->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-[#A4FC00] w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-white">Kamu yakin ingin menghapus Alternatif ini?</h3>
                            <form action="/dashboard/alternatif/{{ $item->id }}" method="POST" id="form-delete-confirm">
                                @method('delete')
                                @csrf
                                <button data-modal-hide="popup-modal-{{ $item->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yes, I'm sure
                                </button>
                                <button data-modal-hide="popup-modal-{{ $item->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-[#A4FC00] rounded-lg border border-[#A4FC00] hover:bg-[#ACFE74] hover:text-[#0D0D0D] focus:z-10 focus:ring-4 focus:ring-[#A4FC00]">No, cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Popup Edit --}}
            <div id="edit-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-[#0D0D0D] rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:px-5 border-b rounded-t border-[#A4FC00]">
                            <h3 class="text-lg text-gray-700 font-bold dark:text-white">
                            Ubah Data Alternatif
                            </h3>
                            <button type="button" class="text-white bg-transparent hover:bg-[#A4FC00] hover:text-[#0D0D0D] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal-{{ $item->id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form id="edit-form" class="p-4 md:px-5 -mt-6" method="POST" action="/dashboard/alternatif/{{ $item->id }}">
                            @method('put')
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2 p-4 md:p-5">
                                <div class="col-span-2">
                                    <label for="kode_alternatif" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Kode Alternatif</label>
                                    <input value="{{ $item->kode_alternatif }}" type="text" name="kode_alternatif" id="kode-alternatif" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A4FC00] focus:border-[#A4FC00] block w-full p-2.5" placeholder="A01" required="">
                                </div>
                                <div class="col-span-2">
                                    <label for="nama_alternatif" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Alternatif</label>
                                    <input value="{{ $item->nama_alternatif }}" type="text" name="nama_alternatif" id="nama_alternatif" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A4FC00] focus:border-[#A4FC00] block w-full p-2.5" placeholder="Alternatif" required="">
                                </div>
                            </div>
                                <button type="submit" class="ml-4 mb-4 text-[0D0D0D] inline-flex items-center bg-[#A4FC00] hover:bg-[#ACFE74] focus:ring-4 focus:outline-none focus:ring-#A4FC00] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Simpan
                                </button>
                        </form>
                    </div>
                </div>
            </div> 
            @empty
                <tr>
                <td class="px-6 py-4 text-center bg-[#1E1E1E] text-white" colspan="4">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
{{-- Popup Create --}}
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="animate__animated animate__zoomIn animate__faster hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-[#0D0D0D] rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg text-gray-700 font-bold dark:text-white">
                Tambah Data Alternatif
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-[#AEFF76] hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="/dashboard/alternatif" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="kode_alternatif" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Kode Alternatif</label>
                        <input type="text" name="kode_alternatif" id="kode_alternatif" class="bg-[#F6F5F8] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A6FF00] focus:border-[#A6FF00] block w-full p-2.5" placeholder="A01" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="nama_alternatif" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Alternatif</label>
                        <input type="text" name="nama_alternatif" id="nama_alternatif" class="bg-[#F6F5F8] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A6FF00] focus:border-[#A6FF00] block w-full p-2.5" placeholder="Alternatif" required="">
                    </div>
                </div>
                <button type="submit" class="text-[#111827] inline-flex items-center bg-[#A6FF00] hover:bg-[#AEFF76] focus:ring-4 focus:outline-none focus:ring-[#A6FF00] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Tambahkan
                </button>
            </form>
        </div>
    </div>
</div> 


</x-layout>