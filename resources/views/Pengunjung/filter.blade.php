<x-layout>
  <x-navigate.navbar></x-navigate.navbar>

  <section class="bg-[#282626] pt-16">
    <h1 class="text-[#E3FC61] font-bold text-3xl text-center py-10">Filter Wisata</h1>
  </section>
  <div class="max-w-4xl mx-auto bg-[#EEEBD3] rounded-lg p-6 shadow-sm">
    <form method="get" action="/filter/wisata" class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 mb-6">
      @csrf
      <label for="filter" class="text-[#18252D] font-semibold text-base mb-2 sm:mb-0"
        >Pilih filter:
      </label>
      <select
        id="filter"
        name="filter"
        class="border border-[#F8C650] rounded-md py-2 px-3 text-[#18252D] text-sm w-full sm:w-60"
      >
        <option value="waktu">Waktu Tempuh Tercepat</option>
        <option value="jarak">Jarak Terdekat</option>
        <option value="fasilitas">Fasilitas Lengkap</option>
      </select>
      <button
        type="submit"
        class="corsor-pointer mt-4 sm:mt-0 bg-[#29581F] text-[#F8C650] font-semibold text-sm py-2 px-6 rounded"
      >
        Filter
      </button>
    </form>

    {{-- <div class="flex flex-col space-y-4">
      @foreach ($data as $item => $value)
      <div
        class="flex justify-between bg-[#F8C650] border border-[#18252D] rounded-lg px-8 py-4 shadow-sm"
        aria-label="Tempat Wisata A card"
      >
      <div>
        <h3 class="font-semibold text-[#18252D] text-lg mb-2">{{ $value['nama_alternatif'] }}</h3>
        <p class="text-gray-700 text-sm mb-1 flex items-center gap-2">
          <i class="far fa-clock"></i> Waktu tempuh: {{ $value['waktu'] }} min
        </p>
        <p class="text-gray-700 text-sm mb-1 flex items-center gap-2">
          <i class="fas fa-map-marker-alt"></i> Jarak: {{ $value['jarak'] }} km
        </p>
        <p class="text-gray-700 text-sm mb-1 flex items-center gap-2">
          <i class="fas fa-map-marker-alt"></i> Fasilitas: {{ $value['fasilitas'] == 1 ? 'Kurang Lengkap' : ($value['fasilitas'] >= 5 ? 'Sangat Lengkap' : 'Cukup Lengkap') }} 
        </p>
      </div>
        <a href="/deskripsi" class="flex items-center justify-center corsor-pointer sm:mt-0 bg-[#29581F] text-[#F8C650] font-semibold text-sm py-2 px-6 rounded">
        Deskripsi
        </a>
      </div>
      @endforeach
    </div> --}}
    <div class="flex flex-col space-y-4">
    {{-- Cek apakah data tersedia --}}
    @forelse ($data as $item => $value)
        <div
            class="flex justify-between bg-[#F8C650] border border-[#18252D] rounded-lg px-8 py-4 shadow-sm"
            aria-label="Tempat Wisata A card"
        >
            <div>
                <h3 class="font-semibold text-[#18252D] text-lg mb-2">{{ $value['nama_alternatif'] }}</h3>
                <p class="text-gray-700 text-sm mb-1 flex items-center gap-2">
                    <i class="far fa-clock"></i> Waktu tempuh: {{ $value['waktu'] ?? '-' }} min
                </p>
                <p class="text-gray-700 text-sm mb-1 flex items-center gap-2">
                    <i class="fas fa-map-marker-alt"></i> Jarak: {{ $value['jarak'] ?? '-' }} km
                </p>
                <p class="text-gray-700 text-sm mb-1 flex items-center gap-2">
                    <i class="fas fa-map-marker-alt"></i> 
                    Fasilitas: 
                    @php
                        $fasilitas = $value['fasilitas'];
                        $labelFasilitas = '-';
                        if (is_numeric($fasilitas)) {
                            if ($fasilitas >= 5) $labelFasilitas = 'Sangat Lengkap';
                            elseif ($fasilitas == 1) $labelFasilitas = 'Kurang Lengkap';
                            else $labelFasilitas = 'Cukup Lengkap';
                        }
                    @endphp
                    {{ $labelFasilitas }}
                </p>
            </div>
            <a href="/deskripsi" class="flex items-center justify-center corsor-pointer sm:mt-0 bg-[#29581F] text-[#F8C650] font-semibold text-sm py-2 px-6 rounded">
                Deskripsi
            </a>
        </div>
    @empty
        <div class="text-center text-gray-600 py-8">
            Tidak ada data ditemukan.
        </div>
    @endforelse
</div>

  </div>


  <x-navigate.footer></x-navigate.footer>
</x-layout>