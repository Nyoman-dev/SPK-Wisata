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
    <div class="pl-68 mx-5 pt-10 relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-white">
      <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-white bg-[#1E1E1E]">
        <div class="flex items-center justify-between">
          <p>Deskripsi Wisata</p>
          {{-- Tombol Tambah Data Start--}}
          <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="text-[#0D0D0D] bg-[#A4FC00] hover:bg-[#ACFE74] focus:ring-4 focus:outline-none focus:ring-[#A4FC00] font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center me-2">
            <svg class="w-6 h-6 text-[#0D0D0D]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
            </svg>
            Tambah Wisata
          </button>
          {{-- Tombol Tambah Data End--}}
        </div>
      </caption>
        <thead class="text-xs text-white uppercase bg-[#0D0D0D]">
          <tr>
            <th scope="col" class="px-6 py-3">
              No
            </th>
            <th scope="col" class="px-6 py-3">
              Judul
            </th>
            <th scope="col" class="px-6 py-3">
              Alamat
            </th>
            <th scope="col" class="px-6 py-3">
              Deskripsi
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
          </tr>
        </thead>
        <tbody>
          @if (count($items) == 0)
          <tr class="bg-[#1E1E1E] border-b border-[#0D0D0D]">
            <th colspan="5" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              <p>Tidak ada data</p>
            </th>
          </tr>
          @else
            @foreach ($items as $item)
            <tr class="bg-[#1E1E1E] border-b border-[#0D0D0D]">
              <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                {{ $loop->iteration }}
              </th>
              <td class="px-6 py-4">
                {{ $item->judul }}
              </td>
              <td class="px-6 py-4">
                {{ $item->alamat }}
              </td>
              <td class="px-6 py-4">
                {{ Str::limit($item->deskripsi, 100) }}
              </td>
              <td class="px-6 py-4">
                {{-- Tombol Edit Start --}}
                <button class="cursor-pointer" data-modal-target="static-modal-{{ $item->id }}" data-modal-toggle="static-modal-{{ $item->id }}" type="button">
                  <svg class="w-6 h-6 text-[#A6FF00]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                  </svg>
                </button>
                {{-- Tombol Hapus Start --}}
                <button class="cursor-pointer" data-modal-target="popup-modal-{{ $item->id }}" data-modal-toggle="popup-modal-{{ $item->id }}" type="button">
                  <svg class="w-6 h-6 text-red-600 dark:text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                  </svg>
                </button>
              </td>
            </tr>
            {{-- Modal Hapus Start --}}
            <div id="popup-modal-{{ $item->id }}" tabindex="-1" class="animate__animated animate__bounceIn animate__faster hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-[#0D0D0D] rounded-lg shadow">
                  <button type="button" class="absolute top-3 end-2.5 text-white bg-transparent hover:bg-[#A6FF00] hover:text-[#0D0D0D] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-{{ $item->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                  </button>
                  <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-[#A6FF00] w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-white">Apakah yakin igin menghapus wisata ini?</h3>
                    <form action="/dashboard/deskripsi/{{ $item->id }}" method="POST">
                      @method('delete')
                      @csrf
                      <button data-modal-hide="popup-modal-{{ $item->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Hapus Wisata
                      </button>
                    </form>
                    <button data-modal-hide="popup-modal-{{ $item->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-[#0D0D0D] focus:outline-none bg-[#A6FF00] rounded-lg border border-[#A6FF00] hover:bg-[#9FF56B] focus:z-10 focus:ring-4 focus:ring-[#9FF56B] ">No, cancel</button>
                  </div>
                </div>
              </div>
            </div>
            {{-- Modal Detail & Edit Start --}}
            <div id="static-modal-{{ $item->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="animate__animated animate__zoomIn animate__faster hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative p-4 w-full max-w-2xl max-h-full">
                  <!-- Modal content -->
                  <div class="relative bg-[#0D0D0D] rounded-lg shadow-sm">
                      <!-- Modal header -->
                      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-[#A6FF00]">
                          <h3 class="text-xl font-semibold text-white">
                            Detail Wisata
                          </h3>
                          <button type="button" class="text-white bg-transparent hover:bg-[#A6FF00] hover:text-[#0D0D0D] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="static-modal-{{ $item->id }}">
                              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                              </svg>
                              <span class="sr-only">Close modal</span>
                          </button>
                      </div>
                      <!-- Modal body -->
                      <form id="edit-form-{{ $item->id }}" class="p-4 md:px-5 -mt-6" method="POST" action="/dashboard/deskripsi/{{ $item->id }}">
                        @method('put')
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2 p-4 md:p-5">
                          <div class="col-span-2">
                            <label for="judul" class="block mb-2 text-sm font-medium text-white">Judul</label>
                            <input value="{{ $item->judul }}" type="text" name="judul" id="judul" class="bg-[#1E1E1E] border border-[#A6FF00] text-white text-sm rounded-lg focus:ring-[#A6FF00] focus:border-[#A6FF00] block w-full p-2.5" placeholder="Nama Tempat Wisata" required="">
                          </div>
                          <div class="col-span-2">
                            <label for="alamat" class="block mb-2 text-sm font-medium text-white">Alamat</label>
                            <input value="{{ $item->alamat }}" type="text" name="alamat" id="alamat" class="bg-[#1E1E1E] border border-[#A6FF00] text-white text-sm rounded-lg focus:ring-[#A6FF00] focus:border-[#A6FF00] block w-full p-2.5" placeholder="Nama Tempat Wisata" required="">
                          </div>
                          <div class="col-span-2">
                            <label for="map" class="block mb-2 text-sm font-medium text-white">Link Map</label>
                            <input value="{{ $item->map }}" type="text" name="map" id="map" class="bg-[#1E1E1E] border border-[#A6FF00] text-white text-sm rounded-lg focus:ring-[#A6FF00] focus:border-[#A6FF00] block w-full p-2.5" placeholder="Link Map" required="">
                          </div>
                            <div class="col-span-2">
                              <label for="deskripsi" class="block mb-2 text-sm font-medium text-white">Deskripsi</label>
                              <textarea name="deskripsi" id="deskripsi" rows="4" class="block p-2.5 h-40 w-full text-sm text-white bg-[#1E1E1E] rounded-lg border border-[#A6FF00] focus:ring-[#A6FF00] focus:border-[#A6FF00]" placeholder="Deskripsi Wisata" required="">{{ $item->deskripsi }}</textarea>
                            </div>
                        </div>
                            <button type="submit" class="ml-4 mb-4 text-[#0D0D0D] inline-flex items-center bg-[#A6FF00] hover:bg-[#9FF56B] focus:ring-4 focus:outline-none focus:ring-[#A6FF00] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                              Edit Wisata
                            </button>
                      </form>
                  </div>
              </div>
            </div>
            @endforeach
          @endif
        </tbody>
    </table>
  </div>
  <!-- Modal Create start -->
  <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-[#0D0D0D] rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-[#A6FF00]">
          <h3 class="text-lg font-semibold text-white">
            Tambah Wisata
          </h3>
          <button type="button" class="text-white bg-transparent hover:bg-[#A6FF00] hover:text-[#0D0D0D] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <form action="/dashboard/deskripsi" method="POST" class="p-4 md:p-5">
          @csrf
          <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2">
              <label for="judul" class="block mb-2 text-sm font-medium text-white">Judul</label>
              <input type="text" name="judul" id="judul" class="bg-[#1E1E1E] border border-[#A6FF00] text-white text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Nama Tempat Wisata" required="">
            </div>
            <div class="col-span-2">
              <label for="alamat" class="block mb-2 text-sm font-medium text-white">Alamat</label>
              <input type="text" name="alamat" id="alamat" class="bg-[#1E1E1E] border border-[#A6FF00] text-white text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Jln. Tempat Wisata" required="">
            </div>
            <div class="col-span-2">
              <label for="map" class="block mb-2 text-sm font-medium text-white">Link Map</label>
              <input type="text" name="map" id="map" class="bg-[#1E1E1E] border border-[#A6FF00] text-white text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Link Map" required="">
            </div>
            <div class="col-span-2">
              <label for="deskripsi" class="block mb-2 text-sm font-medium text-white">Deskripsi</label>
              <textarea name="deskripsi" id="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-white bg-[#1E1E1E] rounded-lg border border-[#A6FF00] focus:ring-[#A6FF00] focus:border-[#A6FF00] " required="" placeholder="Deskripsi Wisata"></textarea>
            </div>
          </div>
          <button type="submit" class="text-[#0D0D0D] inline-flex items-center bg-[#A6FF00] hover:bg-[#9CF268] focus:ring-4 focus:outline-none focus:ring-[#9CF268] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
            Tambah Wisata
          </button>
        </form>
      </div>
    </div>
  </div> 
</x-layout>