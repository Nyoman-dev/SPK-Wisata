<x-layout>
  <x-navigate.sidebar></x-navigate.sidebar>
    <div class="pl-68 mx-5 pt-10 grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-5">
    {{-- Matriks Keputusan --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-white">
        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-white bg-[#1E1E1E]">
          <span>Matriks Keputusan</span>
        </caption>
          <thead class="text-xs text-whiteuppercase bg-[#0D0D0D]">
              <tr>
                  <th scope="col" class="px-6 py-3">
                    Alternatif
                  </th>
                  @foreach ($kriterias as $kriteria)
                    <th scope="col" class="px-6 py-3">
                      {{ $kriteria->nama_kriteria }}
                    </th>
                  @endforeach
              </tr>
          </thead>
          <tbody class="text-white">
            @foreach ($nilais as $kodeAlternatif => $nilai)
            <tr class="bg-[#1E1E1E] border-b text-white border-[#0D0D0D]">
                  <td class="px-6 py-4">
                    {{ $nilai['name'] }}
                  </td>
                  @foreach ($kriterias as $kriteria)
                    <td class="px-6 py-4">
                      {{ $nilai['value'][$kriteria->kode_kriteria] }}
                    </td>
                  @endforeach
            </tr>
            @endforeach
            <tr class="bg-[#1E1E1E] border-b dark:border-[#0D0D0D]">
                  <td class="px-6 py-4">
                    Nilai Min
                  </td>
                  @foreach ($minmax as $kodeKriteria => $nilai)
                    <td class="px-6 py-4">
                      {{ $nilai['min'] }}
                    </td>
                  @endforeach
            </tr>
            <tr class="bg-[#1E1E1E] border-b dark:border-[#0D0D0D]">
                  <td class="px-6 py-4">
                    Nilai Max
                  </td>
                  @foreach ($minmax as $kodeKriteria => $nilai)
                    <td class="px-6 py-4">
                      {{ $nilai['max'] }}
                    </td>
                  @endforeach
            </tr>
          </tbody>
      </table>
    </div>
    {{-- Matriks Ternormalisasi --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-white">
        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-white bg-[#1E1E1E]">
          <span>Matriks Ternormalisasi</span>
        </caption>
          <thead class="text-xs text-white uppercase bg-[#0D0D0D]">
              <tr>
                  <th scope="col" class="px-6 py-3">
                    Alternatif
                  </th>
                  @foreach ($kriterias as $kriteria)
                    <th scope="col" class="px-6 py-3">
                      {{ $kriteria->nama_kriteria }}
                    </th>
                  @endforeach
              </tr>
          </thead>
          <tbody class="text-white">
            @foreach ($normal as $kodeAlternatif => $values)
              <tr class="bg-[#1E1E1E] border-b  border-[#0D0D0D]">
                    <td class="px-6 py-4">
                      {{ $nilais[$kodeAlternatif]['name'] }}  
                    </td>
                    @foreach ($values as $kodeKriteria => $nilai)
                      <td class="px-6 py-4">
                        @if (strpos((string)$nilai, '.') !== false && strlen(substr((string)$nilai, strpos((string)$nilai, '.') + 1)) > 2)
                        {{ number_format($nilai, 2) }}
                      @else
                        {{ $nilai }}
                      @endif
                      </td>
                    @endforeach
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
    {{-- Ternormalisasi X Bobot --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-white">
        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-white bg-[#1E1E1E]">
          <span class="">Ternormalisasi x Bobot</span>
        </caption>
          <thead class="text-xs tex-white uppercase bg-[#0D0D0D]">
              <tr>
                  <th scope="col" class="px-6 py-3">
                    Alternatif
                  </th>
                  @foreach ($kriterias as $kriteria)
                    <th scope="col" class="px-6 py-3">
                      {{ $kriteria->nama_kriteria }}
                    </th>
                  @endforeach
              </tr>
          </thead>
          <tbody class="text-white">
            @foreach ($terbobot as $kodeAlternatif => $values)
              <tr class="bg-[#1E1E1E] border-b dark:border-[#0D0D0D]">
                    <td class="px-6 py-4">
                      {{ $nilais[$kodeAlternatif]['name'] }}
                    </td>
                    @foreach ($values as $kodeKriteria => $nilai)
                      <td class="px-6 py-4">
                        @if (strpos((string)$nilai, '.') !== false && strlen(substr((string)$nilai, strpos((string)$nilai, '.') + 1)) > 2)
                        {{ number_format($nilai, 2) }}
                      @else
                        {{ $nilai }}
                      @endif
                      </td>
                    @endforeach
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
    {{-- Perengkingan --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-white">
        <div class="flex justify-between p-5 text-xl font-semibold text-left rtl:text-right text-white bg-[#1E1E1E]">
          <span>Perengkingan  </span>
        </div>
          <thead class="text-xs text-white uppercase bg-[#0D0D0D]">
              <tr>
                <th scope="col" class="px-6 py-3">
                  Rank
                </th>
                <th scope="col" class="px-6 py-3">
                  Alternatif
                </th>
                  <th scope="col" class="px-6 py-3">
                    Kode
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Total
                  </th>
              </tr>
          </thead>
          <tbody class="text-white">
            @foreach ($rankedTotal as $data)
              <tr class="bg-[#1E1E1E] border-b border-[#0D0D0D]">
                    <td class="px-6 py-4">
                      {{ $data['rank'] }}
                    </td>
                    <td class="px-6 py-4">
                      {{ $data['name'] }}
                    </td>
                    <td class="px-6 py-4">
                      {{ $data['kode_alternatif'] }}
                    </td>
                    <td class="px-6 py-4">
                      {{ number_format($data['total'], 2) }}
                    </td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
</x-layout>