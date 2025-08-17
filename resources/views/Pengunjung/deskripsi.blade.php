<x-layout>
  <x-navigate.navbar></x-navigate.navbar>
  <section class="pt-16">
    <div class="w-full bg-[#282626] px-40 py-10">
      <p class="text-[#E3FC61] text-2xl font-bold">
        Parawisata Kota Palopo
      </p>
    </div>
    @foreach ($data as $item)
      @if ($loop->index % 2 == 0)
      <div class="py-30 bg-[#F8C650] relative overflow-hidden min-h-[400px] flex items-center justify-between px-6">
        <div class="w-1/2 mt-10 md:mt-0 md:ml-16 max-w-xl text-[#1a202c]">
          <h1 class="font-bold text-[40px] leading-[44px] text-[#1f3f1f] uppercase">
            {{ $item->judul }}
          </h1>
          <p class="mt-6 font-semibold text-[#1f1f1f] text-[18px] ">
          {{ $item->alamat }}
          </p>
          <p class="mt-4 text-[#1f1f1f] text-[16px] leading-[26px] ">
            {{ $item->deskripsi }}
          </p>
        </div>
        <div class="flex items-center justify-center gap-2">
          <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-[400px] h-[300px] object-cover">
          <div>
            {!! $item->map !!}
          </div>
        </div>
      </div>
      @else
      <div class="py-30 relative bg-[#ede9d1] overflow-hidden min-h-[400px] flex items-center justify-between px-6">
          <div class="flex flex-col md:flex-row items-center justify-between gap-2">
            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-[400px] h-[300px] object-cover">
            <div class="relative w-1/2 max-w-[400px] md:max-w-[480px] flex-shrink-0">
              {!! $item->map !!}
            </div>
          </div>
          <div class="mt-10 md:mt-0 md:ml-16 max-w-xl text-[#1a202c]">
            <h2 class="font-anton text-[#ff6a3d] text-4xl md:text-5xl leading-tight tracking-tight">
              {{ $item->judul }}
            </h2>
            <p class="mt-6 font-semibold text-lg leading-relaxed max-w-xl">
              {{ $item->alamat }}
            </p>
            <p class="mt-6 text-base leading-relaxed max-w-xl">
              {{ $item->deskripsi }}
            </p>
          </div>
      </div>
      @endif
    @endforeach

  
  </section>

  <x-navigate.footer></x-navigate.footer>
</x-layout>