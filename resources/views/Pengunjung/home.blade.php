<x-layout>
  <x-navigate.navbar></x-navigate.navbar>
    <section class="bg-[#282626] relative overflow-hidden pt-20">
      <div class="max-w-7xl mx-auto px-6 py-16 flex flex-col md:flex-row items-center md:items-start gap-8 md:gap-0">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
          <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Wonderful in the world’s parawisata</h1>
          <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">Here at team we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
        </div>
        <div class="md:w-1/2 relative flex justify-center md:justify-end">
          <img alt="hero-image" class="w-[600px] max-w-full h-auto rounded-[50%_50%_50%_50%/40%_40%_60%_60%]" height="600" src="img/agung.jpg" width="600"/>
        </div>
      </div>
    </section>
    <section class="bg-[#F9F6E8] w-full px-30 py-30 flex flex-col lg:flex-row items-center lg:items-start justify-center gap-10 lg:gap-20">
      <div class="flex flex-col max-w-xl w-full">
        <h1 class="font-fredoka font-bold text-[2.75rem] leading-[1.1] text-[#2F572F] mb-8">
          You've come to the right place.
        </h1>
        <div class="mb-10">
          <h2 class="font-semibold text-lg leading-6 mb-3">
            Dream Green is a community that<br />
            helps people get guerrilla gardening.
          </h2>
          <p class="text-base leading-6 max-w-md">
            Here, you'll find information, inspiration, and resources to help you
            reclaim neglected corners of your neighbourhood, and transform them
            from grey to green.
          </p>
        </div>
        <form class="bg-[#F7C24B] rounded-3xl px-8 py-6 max-w-md w-full flex flex-col gap-4">
          <h3 class="font-fredoka text-xl text-[#18252D] mb-2">What Next</h3>
            <div class="flex gap-4">
              <a
                  href="/profil"
                  class="bg-[#18252D] text-[#F7C24B] w-full font-semibold rounded-full px-5 py-3 flex items-center justify-center min-w-[56px]"
                  type="submit">
                  Explore
              </a>
            </div>
        </form>
      </div>
        <section class="flex-shrink-0 max-w-[480px] w-full relative items-center">
        <img
            alt="Black and white halftone style image of a hand holding a small leafy plant with an abstract organic shape"
            src="{{ asset('img/jodoh.jpg') }}"
            class="w-full h-auto object-cover custom-shape rounded-3xl"
        />
        </section>
    </section>
  <x-navigate.footer></x-navigate.footer>
</x-layout>
