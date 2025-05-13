<x-layout>
  <x-navigate.navbar></x-navigate.navbar>

  <section class="bg-[#282626] pt-16">
    <h1 class="text-[#E3FC61] font-bold text-3xl text-center py-10">Profil Dinas Pariwisata</h1>
  </section>

  <section class="bg-[#F9F6E8] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 py-16 flex flex-col md:flex-row items-center md:items-start gap-8 md:gap-0">
    @foreach ($data as $item)
    <div class="md:w-1/2 text-[#29581F] font-bold">
      <h2 class="font-anton text-[32px] sm:text-[36px] md:text-[40px] leading-tight mb-4">
        {{ $item->judul }}
      </h2>
      <p class="font-semibold text-black text-lg mb-6 max-w-xl">
        {{ $item->deskripsi }}
      </p>
      <p class="text-[#18252D] text-base mb-6 max-w-xl">
        Instansi pemerintah yang berada dan bertanggung jawab kepada Gubernur melalui Sekretaris Daerah, yang merupakan lini terdepan pemerintah Palopo dalam pengelolaan potensi pariwisata
      </p>
      <p class="text-[#18252D] text-base max-w-xl">
        Fungsi dan tata Kerja Dinas Pariwisata Kota Palopo, mempunyai tugas melaksanakan urusan pemerintahan yang menjadi kewenangan daerah di bidang pariwisata.
      </p>
    </div>
    @endforeach
    <div class="md:w-1/2 relative flex justify-center md:justify-end">
      <img alt="jami" class="w-[600px] max-w-full h-auto rounded-[50%_50%_50%_50%/40%_30%_80%_80%]" height="600" src="img/jami.jpeg" width="600"/>
      <a href="/deskripsi" class="absolute top-[50%] left-[30%] -translate-y-1/2 bg-[#c6f4c6] rounded-full px-8 py-4 max-w-[180px] text-center">
        <span class="font-anton text-[#7f72bb] text-[20px] sm:text-[22px] md:text-[24px] leading-tight block">
        Explore
        <br/>
        More
        </span>
      </a>
      </div>
    </div>
  </section>
  

  <x-navigate.footer></x-navigate.footer>
</x-layout>