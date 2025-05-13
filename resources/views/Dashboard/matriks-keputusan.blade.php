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
    <table class="w-full text-sm text-left rtl:text-right">
      <div class="flex justify-between p-5 text-xl font-semibold text-left rtl:text-right text-white bg-[#1E1E1E]">
        <span>Matriks Keputusan</span>
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="gap-2 text-[#0D0D0D] bg-[#A6FF00] hover:bg-[#9CF268] focus:ring-4 focus:outline-none focus:ring-[#9CF268] font-medium rounded-lg text-sm px-4 py-1.5 text-center inline-flex items-center me-2">
          <svg class="w-4 h-4 text-[#0D0D0D]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="2" height="2" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
          </svg>
            Tambah Data
          </button>
      </div>
        <thead class="text-xs text-white uppercase bg-[#0D0D0D]">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Kode
                </th>
                <th scope="col" class="px-6 py-3">
                  Alternatif
                </th>
                @foreach ($kriterias as $kriteria)
                <th scope="col" class="px-6 py-3">
                  {{ $kriteria->nama_kriteria }}
                </th>
                @endforeach
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="text-white ">
          @foreach ($nilais as $kodeAlternatif => $nilai)
          <tr class="border-b bg-[#1E1E1E] border-[#0D0D0D]">
                <td scope="row" class="px-6 py-4">
                  {{ $kodeAlternatif }}
                </td>
                <td class="px-6 py-4">
                  {{ $nilai['name'] }}
                </td>
                @foreach ($kriterias as $kriteria)
                <td class="px-6 py-4">
                  {{ $nilai['value'][$kriteria->kode_kriteria] }}
                </td>
                @endforeach
                <td class="px-6 py-4 flex gap-1.5">
                  <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"><svg class="w-6 h-6 text-[#A6FF00]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                  </svg>
                  </button>
              </td>
          </tr>
          {{-- Popup Edit --}}
          <div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-[#0D0D0D] rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-[#A6FF00]">
                        <h3 class="text-lg font-bold text-white">
                          Ubah Data Matriks
                        </h3>
                        <button type="button" class="text-white bg-transparent hover:bg-[#A6FF00] hover:text-[#0D0D0D] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5 -mt-6" method="POST" action="/dashboard/matriks/{{ $kodeAlternatif }}">
                      @method('put')
                      @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2 p-4 md:p-5">
                            <div class="col-span-2">
                                <label for="kode_alternatif" class="block mb-2 text-sm font-semibold text-white">Alternatif</label>
                                <input value="{{ $kodeAlternatif }}" type="text" name="kode_alternatif" id="kode-alternatif" class="bg-[#1E1E1E] border border-[#A6FF00] text-white text-sm rounded-lg focus:ring-[#A6FF00] focus:border-[#A6FF00] block w-full p-2.5" placeholder="A01" required="">
                            </div>
                            @foreach ($kriterias as $kriteria)
                            <input type="hidden" name="kode_kriteria[]" value="{{ $kriteria->kode_kriteria }}">
                            <div class="col-span-2 flex items-baseline">
                              <label for="nilai_{{ $kriteria->kode_kriteria }}" class="block w-3/5 mb-2 text-sm font-semibold text-gray-700 dark:text-white">{{ $kriteria->nama_kriteria }}</label>
                              <select id="nilai_{{ $kriteria->kode_kriteria }}" name="nilai[{{ $kriteria->kode_kriteria }}][]" class="bg-[#1E1E1E] border border-[#A6FF00] text-white text-sm rounded-lg focus:ring-[#A6FF00] focus:border-[#A6FF00] block w-full p-2.5">
                                @foreach ($kriteria->nilaibobot as $bobot)
                                <option value="{{ $bobot->nilai }}">{{ $bobot->nama }}</option>
                                @endforeach
                              </select>
                            </div>
                          @endforeach
                        </div>
                        <button type="submit" class="ml-4 mb-4 text-[#0D0D0D] inline-flex items-center bg-[#A6FF00] hover:bg-[#9CF268] focus:ring-4 focus:outline-none focus:ring-[#A6FF00] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
          </div>
          @endforeach
        </tbody>
    </table>
  </div>

{{-- Popup Create --}}
  <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-[#0D0D0D] rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-[#A6FF00]">
                <h3 class="text-lg font-bold text-white">
                  Ubah Data Matriks
                </h3>
                <button type="button" class="text-white bg-transparent hover:bg-[#A6FF00] hover:text-[#0D0D0D] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            @if ($alternatifs->isEmpty())
            <div class="text-white font-medium p-4 text-md text-center">
              Data alternatif baru tidak tersedia, tambahkan alternatif terlebih dahulu !!
            </div>
            @else
            <form class="p-4 md:p-5" method="POST" action="/dashboard/matriks">
                @csrf
              <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                  <label for="kode_alternatif" class="block mb-2 text-sm font-semibold text-white">Alternatif</label>
                  <select id="kode_alternatif" name="kode_alternatif" class="bg-[#1E1E1E] border border-[#A6FF00] text-white text-sm rounded-lg focus:ring-[#A6FF00] focus:border-[#A6FF00] block w-full p-2.5">
                    @foreach ($alternatifs as $alternatif)
                    <option value="{{ $alternatif->kode_alternatif }}">{{ $alternatif->nama_alternatif }}</option>
                    @endforeach
                  </select>
                </div>
                @foreach ($kriterias as $kriteria)
                  <input type="hidden" name="kode_kriteria[]" value="{{ $kriteria->kode_kriteria }}">
                  <div class="col-span-2 flex items-baseline">
                    <label for="nilai_{{ $kriteria->kode_kriteria }}" class="block w-3/5 mb-2 text-sm font-semibold text-white">{{ $kriteria->nama_kriteria }}</label>
                    <select id="nilai_{{ $kriteria->kode_kriteria }}" name="nilai[{{ $kriteria->kode_kriteria }}][]" class="bg-[#1E1E1E] border border-[#A6FF00] text-white text-sm rounded-lg focus:ring-[#A6FF00] focus:border-[#A6FF00]  block w-full p-2.5">
                      @foreach ($kriteria->nilaibobot as $bobot)
                      <option value="{{ $bobot->nilai }}">{{ $bobot->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                @endforeach
              </div>
              <button type="submit" class="text-[#0D0D0D] inline-flex items-center bg-[#A6FF00] hover:bg-[#9CF268] focus:ring-4 focus:outline-none focus:ring-[#9CF268] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Simpan
              </button>
            </form>
            @endif
        </div>
    </div>
  </div>
</x-layout>