<x-layout>
    <section>
        <div class="w-full bg-[#282626] px-6 md:px-20 lg:px-40 py-6 md:py-10">
            <a href="/filter"
                class="text-[#E3FC61] text-xl md:text-2xl font-bold text-center md:text-left flex items-center gap-2 hover:text-[#1f3f1f]">
                <svg class="w-6 h-6 text-[#E3FC61]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
                Back to Rekomendasi
            </a>
        </div>

        @foreach ($data as $item)
            <!-- Bagian genap -->
            <div
                class="py-10 md:py-20 bg-[#F8C650] relative overflow-hidden min-h-[400px] flex flex-col md:flex-row items-center md:items-start justify-between px-4 md:px-10 lg:px-20 gap-6">
                <div class="w-full md:w-1/3 text-[#1a202c]">
                    <h1
                        class="font-bold text-2xl md:text-4xl leading-tight text-[#1f3f1f] uppercase text-center md:text-left">
                        {{ $item->judul }}
                    </h1>
                    <p class="mt-4 md:mt-6 font-semibold text-[#1f1f1f] text-base md:text-lg text-center md:text-left">
                        {{ $item->alamat }}
                    </p>
                    <p
                        class="mt-3 md:mt-4 text-[#1f1f1f] text-sm md:text-base leading-relaxed text-justify md:text-left">
                        {{ $item->deskripsi }}
                    </p>
                </div>
                <div class="flex flex-col md:flex-row items-center justify-center gap-4 md:gap-6">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                        class="w-full md:w-[350px] lg:w-[400px] h-[220px] md:h-[300px] object-cover rounded-xl shadow-md">
                    <div class="w-full md:w-[300px] lg:w-[400px]">
                        {!! $item->map !!}
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <x-navigate.footer></x-navigate.footer>
</x-layout>
