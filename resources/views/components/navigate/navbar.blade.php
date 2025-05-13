<nav class="bg-[#F9F6E8] fixed w-full z-20 top-0 start-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-[#29581F]">Parawisata</span>
        </a>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-bold border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-[#F9F6E8]">
                <li>
                    <a href="/" class={{ request()->is('/') ?'text-[#F8C650]' : 'nav'}}>Home</a>
                </li>
                <li>
                    <a href="/profil" class={{ request()->is('profil') ?'text-[#F8C650]' : 'nav' }}>Profil</a>
                </li>
                <li>
                    <a href="/filter" class={{ request()->is('filter') ? 'text-[#F8C650]' : 'nav' }}>Filter</a>
                </li>
                <li>
                    <a href="/deskripsi" class={{ request()->is('deskripsi') ? 'text-[#F8C650]' : 'nav' }}>Deskripsi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>