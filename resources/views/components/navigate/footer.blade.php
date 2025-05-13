<footer class="bg-[#29581F]">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-[#C8F0C8]">Pawaisata</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-[#C8F0C8] sm:mb-0">
                <li>
                    <a href="" class="hover:underline me-4 md:me-6">Home</a>
                </li>
                <li>
                    <a href="/profil" class="hover:underline me-4 md:me-6">Profil</a>
                </li>
                <li>
                    <a href="/filter" class="hover:underline me-4 md:me-6">Filter</a>
                </li>
                <li>
                    <a href="/deskripsi" class="hover:underline me-4 md:me-6">Deskripsi</a>
                </li>
                @guest
                <li>
                    <a href="/login" target="_blank" class="hover:underline">Login</a>
                </li>
                @endguest
            </ul>
        </div>
        <hr class="my-6 border-[#142c0e] sm:mx-auto lg:my-8" />
        <span class="block text-sm text-[#F8C650] sm:text-center">© 2023 <a href="/" class="hover:underline">Pawaisata</a>. All Rights Reserved.</span>
    </div>
</footer>

