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
  <div class="pl-68 mx-5 pt-10 text-xl mb-5 font-bold text-left rtl:text-right text-[#0D0D0D]">
    Nilai Bobot
  </div>
  <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 pl-68 mx-5 pt-10">
    @foreach ($kriteria as $item)
    <div class="max-w-sm flex justify-between p-6 bg-[#0D0D0D] border border-[#0D0D0D] rounded-lg shadow">
      <div class="text-white">
        <h5 class="mb-2 text-lg font-bold tracking-tight">{{ $item->nama_kriteria }}</h5>
        <p class="text-base font-medium">Kode : {{ $item->kode_kriteria }}</p>
        <p class="text-base font-medium">Nilai Bobot : {{ $item->nilaibobot_count }}</p>
      </div>
      <div class="flex items-center">
      <button data-modal-target="edit-modal-{{ $item->id }}" data-modal-toggle="edit-modal-{{ $item->id }}" type="button" class="max-h-10 bg-[#A6FF00] hover:bg-[#9CF268] focus:ring-4 focus:outline-none focus:ring-[#9CF268] font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center me-2 ">
        <svg class="w-6 h-6 text-[#0D0D0D]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
        </svg>
      </button>
      </div>
    </div>
    {{-- Popup Edit --}}
    <div id="edit-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-[#0D0D0D] rounded-lg shadow">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-[#A6FF00]">
                  <h3 class="text-lg text-white">
                    Ubah Nilai Bobot
                  </h3>
                  <button type="button" class="text-white bg-transparent hover:bg-[#A6FF00] hover:text-[#0D0D0D] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal-{{ $item->id }}">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              @foreach ($item->nilaibobot as $bobot)
              <form class="p-4 md:p-5" method="POST" action="/dashboard/sub-bobot/{{ $bobot->id }}">
                @method('put')
                @csrf
                <input type="hidden" name="bobot_id[]" value="{{ $bobot->id }}">
                <div class="grid gap-4 mb-4 grid-cols-2">
                  <div class="col-span-2 sm:col-span-1">
                    @if ($loop->first)
                    <label for="nama" class="block mb-2 text-sm font-semibold text-white">{{ $item->nama_kriteria }}</label>
                    @endif
                    <input value="{{ $bobot->nama }}" type="text" name="nama[]" id="nama-{{ $bobot->id }}" class="bg-[#1E1E1E] border border-[#0D0D0D] text-white text-sm rounded-lg focus:ring-[#A6FF00] focus:border-[#A6FF00] block w-full p-2.5  dark:text-white" placeholder="" required="">
                  </div>
                  <div class="col-span-2 sm:col-span-1">
                    @if ($loop->first)
                    <label for="nilai" class="block mb-2 text-sm font-semibold text-white">Bobot</label>
                    @endif
                    <input value="{{ $bobot->nilai }}" type="number" name="nilai[]" id="nilai-{{ $bobot->id }}" class="bg-[#1E1E1E] border border-[#0D0D0D] text-white text-sm rounded-lg focus:ring-[#A6FF00] focus:border-[#A6FF00] block w-full p-2.5  dark:text-white" placeholder="" required="">
                  </div>
                </div>
                @endforeach
              <button type="submit" class="text-[#0D0D0D] inline-flex items-center bg-[#A6FF00] hover:bg-[#9CF268] focus:ring-4 focus:outline-none focus:ring-[#9CF268] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Simpan
              </button>
              </form>
          </div>
      </div>
    </div>
    @endforeach
  </div>
</x-layout>