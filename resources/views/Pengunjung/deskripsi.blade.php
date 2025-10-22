<x-layout>
    <x-navigate.navbar></x-navigate.navbar>
    <section class="pt-16">
        <div class="w-full bg-[#282626] px-6 md:px-20 lg:px-40 py-6 md:py-10">
            <p class="text-[#E3FC61] text-xl md:text-2xl font-bold text-center md:text-left">
                Pariwisata Kota Palopo
            </p>
        </div>

        @foreach ($data as $item)
            @if ($loop->index % 2 == 0)
                <!-- Bagian genap -->
                <div
                    class="py-10 md:py-20 bg-[#F8C650] relative overflow-hidden min-h-[400px] flex flex-col md:flex-row items-center md:items-start justify-between px-4 md:px-10 lg:px-20 gap-6">
                    <div class="w-full md:w-1/3 text-[#1a202c]">
                        <h1
                            class="font-bold text-2xl md:text-4xl leading-tight text-[#1f3f1f] uppercase text-center md:text-left">
                            {{ $item->judul }}
                        </h1>
                        <p
                            class="mt-4 md:mt-6 font-semibold text-[#1f1f1f] text-base md:text-lg text-center md:text-left">
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
            @else
                <!-- Bagian ganjil -->
                <div
                    class="py-10 md:py-20 relative bg-[#ede9d1] overflow-hidden min-h-[400px] flex flex-col md:flex-row items-center justify-between px-4 md:px-10 lg:px-20 gap-6">
                    <div class="flex flex-col md:flex-row items-center gap-4 md:gap-6">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                            class="w-full md:w-[350px] lg:w-[400px] h-[220px] md:h-[300px] object-cover rounded-xl shadow-md">
                        <div class="w-full md:w-[300px] lg:w-[400px]">
                            {!! $item->map !!}
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 text-[#1a202c] text-center md:text-left">
                        <h2 class="font-anton text-[#ff6a3d] text-2xl md:text-5xl leading-tight tracking-tight">
                            {{ $item->judul }}
                        </h2>
                        <p class="mt-4 md:mt-6 font-semibold text-base md:text-lg leading-relaxed">
                            {{ $item->alamat }}
                        </p>
                        <p class="mt-3 md:mt-6 text-sm md:text-base leading-relaxed">
                            {{ $item->deskripsi }}
                        </p>
                    </div>
                </div>
            @endif
        @endforeach
    </section>

    <x-navigate.footer></x-navigate.footer>
</x-layout>
