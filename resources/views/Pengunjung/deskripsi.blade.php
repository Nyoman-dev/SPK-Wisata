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
      <div class="py-30 bg-[#F8C650] relative overflow-hidden min-h-[400px] flex items-center justify-between px-6 sm:px-12 md:px-20 lg:px-32 xl:px-40 2xl:px-48">
        <div class="max-w-2xl">
          <h1 class="font-bold text-[40px] leading-[44px] text-[#1f3f1f] uppercase max-w-[320px] sm:max-w-[400px] md:max-w-[480px]">
            {{ $item->judul }}
          </h1>
          <p class="mt-6 font-semibold text-[#1f1f1f] text-[18px] leading-[24px] max-w-[480px]">
          {{ $item->alamat }}
          </p>
          <p class="mt-4 text-[#1f1f1f] text-[16px] leading-[26px] max-w-[480px]">
            {{ $item->deskripsi }}
          </p>
        </div>
        <div>
          {!! $item->map !!}
        </div>
      </div>
      @else
      <div class="relative bg-[#ede9d1] overflow-hidden">
        <div class="md:flex md:items-center md:justify-center max-w-7xl mx-auto px-6 py-10 md:py-16">
          <div class="relative w-full max-w-[400px] md:max-w-[480px] flex-shrink-0">
            {!! $item->map !!}
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
      </div>
      @endif
    @endforeach

  
  </section>

  <x-navigate.footer></x-navigate.footer>
</x-layout>