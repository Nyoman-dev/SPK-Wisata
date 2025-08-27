<x-layout>
  <x-navigate.navbar></x-navigate.navbar>
  <section class="pt-16 bg-[#ede9d1] ">
    <div class="w-full bg-[#282626] px-40 py-10">
      <p class="text-[#E3FC61] text-2xl font-bold">
        Rekomendasi Parawisata Kota Palopo
      </p>
    </div>
    <div class="relative overflow-x-auto mx-40 my-10">
@php
    $kriteriaMap = [
        'C01' => 'Jarak',
        'C02' => 'Waktu',
        'C03' => 'Fasilitas',
    ];
@endphp

<table class="w-full text-sm text-left rtl:text-right text-white">
    <thead class="text-xs text-white uppercase bg-[#282626]">
        <tr>
            <th class="px-6 py-3">Rank</th>
            <th class="px-6 py-3">Tempat Wisata (Alternatif)</th>
            @foreach ($kriteriaMap as $label)
                <th class="px-6 py-3">{{ $label }}</th>
            @endforeach
            <th class="px-6 py-3">Total SAW</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rankedTotal as $ranked)
            @php
                $kode = $ranked['kode_alternatif'];
                $data = $datas[$kode] ?? null;
            @endphp

            @if ($data)
                <tr class="bg-[#ede9d1] text-[#282626] border border-[#282626]">
                    <td class="px-6 py-4 font-bold">
                        {{ $ranked['rank'] }}
                    </td>
                    <td class="px-6 py-4 font-medium whitespace-nowrap">
                        {{ $data['name'] }}
                    </td>

                    {{-- loop kolom sesuai urutan --}}
                    @foreach ($kriteriaMap as $kodeKriteria => $label)
                        <td class="px-6 py-4">
                            {{ $data['value'][$kodeKriteria]['nama'] ?? '-' }}
                        </td>
                    @endforeach

                    <td class="px-6 py-4 font-semibold">
                        {{ $ranked['total'] }}
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>




    </div>

  </section>

  <x-navigate.footer></x-navigate.footer>
</x-layout>