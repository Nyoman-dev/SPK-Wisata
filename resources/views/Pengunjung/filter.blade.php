<x-layout>
    <x-navigate.navbar></x-navigate.navbar>

    <section class="bg-[#282626] pt-16">
        <h1 class="text-[#E3FC61] font-bold text-3xl text-center py-10">Filter Wisata</h1>
    </section>

    <div class="max-w-[930px] mx-auto bg-[#EEEBD3] rounded-lg p-6 shadow-sm">
        <form id="filterForm" class="flex flex-col w-full sm:flex-row sm:items-center sm:space-x-4 mb-6">
            @csrf
            <div>
                <label for="filter_jarak" class="text-[#18252D] font-semibold text-base mb-2 sm:mb-0">
                    Filter Jarak
                </label>
                <select id="filter_jarak" name="filter_jarak"
                    class="border border-[#F8C650] rounded-md py-2 px-3 text-[#18252D] text-sm w-full sm:w-60">
                    <option value="C01-1">Jarak Tempuh (<= 1 km)</option>
                    <option value="C01-3">Jarak Tempuh (2 - 5 km)</option>
                    <option value="C01-5">Jarak Tempuh (> 5 km)</option>
                </select>
            </div>

            <div>
                <label for="filter_waktu" class="text-[#18252D] font-semibold text-base mb-2 sm:mb-0">
                    Filter Waktu Tempuh
                </label>
                <select id="filter_waktu" name="filter_waktu"
                    class="border border-[#F8C650] rounded-md py-2 px-3 text-[#18252D] text-sm w-full sm:w-60">
                    <option value="C02-1">Waktu Tempuh (<= 10 min)</option>
                    <option value="C02-3">Waktu Tempuh (11 - 20 min)</option>
                    <option value="C02-5">Waktu Tempuh (> 20 min)</option>
                </select>
            </div>

            <div>
                <label for="filter_fasilitas" class="text-[#18252D] font-semibold text-base mb-2 sm:mb-0">
                    Filter Fasilitas
                </label>
                <select id="filter_fasilitas" name="filter_fasilitas"
                    class="border border-[#F8C650] rounded-md py-2 px-3 text-[#18252D] text-sm w-full sm:w-60">
                    <option value="C03-5">Sangat Lengkap</option>
                    <option value="C03-3">Cukup Lengkap</option>
                    <option value="C03-1">Tidak Lengkap</option>
                </select>
            </div>

            <button type="submit"
                class="corsor-pointer mt-5 bg-[#29581F] text-[#F8C650] font-semibold text-sm py-2 px-9 rounded">
                Filter
            </button>
        </form>

        <div id="resultsContainer" class="flex flex-col space-y-4 h-96 overflow-y-auto scrollbar-hide">
            {{-- Hasil filter akan ditampilkan di sini --}}
        </div>
    </div>

    <x-navigate.footer></x-navigate.footer>

    <script>
        document.getElementById('filterForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const filterJarak = document.getElementById('filter_jarak').value;
            const filterWaktu = document.getElementById('filter_waktu').value;
            const filterFasilitas = document.getElementById('filter_fasilitas').value;
            const token = document.querySelector('input[name="_token"]').value;

            const formData = new URLSearchParams();
            formData.append('_token', token);
            formData.append('filter_jarak', filterJarak);
            formData.append('filter_waktu', filterWaktu);
            formData.append('filter_fasilitas', filterFasilitas);

            const container = document.getElementById('resultsContainer');

            // 🔹 Tambahkan teks loading sebelum fetch
            container.innerHTML =
                '<div class="text-center text-gray-600 py-8 animate-pulse">Proses mencari...</div>';

            fetch('/filter-wisata', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': token
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    container.innerHTML = ''; // Kosongkan dulu setelah data diterima

                    // Periksa apakah data.rankedTotal dan data.result ada dan tidak kosong
                    if (!data.rankedTotal || data.rankedTotal.length === 0 || !data.result || data.result
                        .length === 0) {
                        container.innerHTML =
                            '<div class="text-center text-gray-600 py-8">Tidak ada data ditemukan.</div>';
                        return;
                    }

                    // 🔹 Buat map nama_alternatif → deskripsi kriterianya
                    const resultMap = {};
                    data.result.forEach(item => {
                        resultMap[item.nama_alternatif] = {
                            jarak: item.kriterias.find(k => k.nama_kategori === "jarak")
                                ?.deskripsi ?? "-",
                            waktu: item.kriterias.find(k => k.nama_kategori === "waktu")
                                ?.deskripsi ?? "-",
                            fasilitas: item.kriterias.find(k => k.nama_kategori === "fasilitas")
                                ?.deskripsi ?? "-"
                        };
                    });

                    // Ambil data ranking dari 'rankedTotal'
                    const rankedData = data.rankedTotal;

                    // Buat tabelnya
                    const tableHTML = `
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-white">
                    <thead class="text-xs text-white uppercase bg-[#282626]">
                        <tr>
                            <th class="px-6 py-3">Tempat Wisata</th>
                            <th class="px-6 py-3">Nilai SAW</th>
                            <th class="px-6 py-3">Jarak</th>
                            <th class="px-6 py-3">Waktu</th>
                            <th class="px-6 py-3">Fasilitas</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        ${rankedData.map(item => {
                            const slug = item.name.replace(/\s+/g, '-').toLowerCase();
                            const krit = resultMap[item.name]; // cocokkan dengan hasil filter
                            return `
                                                                <tr class="bg-[#ede9d1] text-[#282626] border border-[#282626]">
                                                                    <td class="px-6 py-4 font-medium whitespace-nowrap">${item.name}</td>
                                                                    <td class="px-6 py-4">${item.total.toFixed(2)}</td>
                                                                    <td class="px-6 py-4">${krit ? krit.jarak : "-"}</td>
                                                                    <td class="px-6 py-4">${krit ? krit.waktu : "-"}</td>
                                                                    <td class="px-6 py-4">${krit ? krit.fasilitas : "-"}</td>
                                                                    <td class="px-6 py-4">
                                                                        ${krit ? `<a href="/deskripsi/${slug}" class="bg-[#29581F] text-[#F8C650] font-semibold text-sm py-2 px-6 rounded cursor-pointer">Deskripsi</a>` : ""}
                                                                    </td>
                                                                </tr>
                                                            `;
                        }).join('')}
                    </tbody>
                </table>
            </div>
        `;

                    container.innerHTML = tableHTML;
                })
                .catch(error => {
                    console.error('Gagal fetch data:', error);
                    container.innerHTML =
                        '<div class="text-center text-red-600 py-8">Terjadi kesalahan saat memuat data.</div>';
                });
        });
    </script>

</x-layout>
