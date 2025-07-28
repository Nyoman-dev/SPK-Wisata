<x-layout>
  <x-navigate.navbar></x-navigate.navbar>

    <section class="bg-[#282626] pt-16">
      <h1 class="text-[#E3FC61] font-bold text-3xl text-center py-10">Filter Wisata</h1>
    </section>
  <div class="max-w-4xl mx-auto bg-[#EEEBD3] rounded-lg p-6 shadow-sm">
    <form id="filterForm" method="POST" class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 mb-6">
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

    <div id="resultsContainer" class="flex flex-col space-y-4 h-96 overflow-y-auto scrollbar-hide">
      {{-- ... isi kartu tempat wisata --}}
    </div>
  </div>
  
  <x-navigate.footer></x-navigate.footer>

  <script>
    document.getElementById('filterForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const filter = document.getElementById('filter').value;
        const token = document.querySelector('input[name="_token"]').value;

        fetch('/filter-wisata', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': token
            },
            body: new URLSearchParams({
                _token: token,
                filter: filter
            })
        })
        .then(response => response.json())
            .then(data => {
                const container = document.getElementById('resultsContainer');
                container.innerHTML = ''; // Kosongkan dulu

                if (data.length === 0) {
                    container.innerHTML = '<div class="text-center text-gray-600 py-8">Tidak ada data ditemukan.</div>';
                    return;
                }

                data.forEach(item => {
                    const fasilitasLabel = item.fasilitas >= 5 ? 'Sangat Lengkap' :
                                            item.fasilitas == 1 ? 'Kurang Lengkap' : 'Cukup Lengkap';

                    const card = `
                    <div class="flex justify-between bg-[#F8C650] border border-[#18252D] rounded-lg px-8 py-4 shadow-sm">
                        <div>
                            <h3 class="font-semibold text-[#18252D] text-lg mb-2">${item.nama_alternatif}</h3>
                            <p class="text-gray-700 text-sm mb-1 flex items-center gap-2">
                                <i class="far fa-clock"></i> Waktu tempuh: ${item.waktu ?? '-'} min
                            </p>
                            <p class="text-gray-700 text-sm mb-1 flex items-center gap-2">
                                <i class="fas fa-map-marker-alt"></i> Jarak: ${item.jarak ?? '-'} km
                            </p>
                            <p class="text-gray-700 text-sm mb-1 flex items-center gap-2">
                                <i class="fas fa-map-marker-alt"></i> Fasilitas: ${fasilitasLabel}
                            </p>
                        </div>
                        <a href="/deskripsi" class="flex items-center justify-center corsor-pointer sm:mt-0 bg-[#29581F] text-[#F8C650] font-semibold text-sm py-2 px-6 rounded">
                            Deskripsi
                        </a>
                    </div>
                    `;

                    container.innerHTML += card;
                });
            })
            .catch(error => {
            console.error('Gagal fetch data:', error);
        });
    });
  </script>

</x-layout>