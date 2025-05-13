<x-layout>
  <section class="bg-[#282626] h-screen flex items-center justify-center">
    <div class="w-full max-w-sm p-4 bg-[#282626] rounded-lg sm:p-6 md:p-8">
      @if (session()->has('eror'))
      <div id="toast-warning" class="flex items-center mx-auto w-full max-w-xs p-4 text-[#FF663D] rounded-lg shadow  bg-[#E3FC61]" role="alert">
          <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
              </svg>
              <span class="sr-only">Warning icon</span>
          </div>
          <div class="ms-3 text-sm font-normal">{{ session('eror') }}</div>
          <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[#E3FC61] text-[#FF663D] hover:bg-[#efffa0] rounded-lg focus:ring-2 focus:ring-[#FF663D] p-1.5 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-warning" aria-label="Close">
              <span class="sr-only">Close</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
              </svg>
          </button>
      </div>
      @endif
      <form class="space-y-6" action="/login" method="POST">
        @csrf
          <h5 class="text-xl font-bold text-[#E3FC61]">Loginto Dashboard</h5>
          <div>
              <label for="email" class="block mb-2 text-sm font-bold text-[#E3FC61]">Your email</label>
              <input type="email" name="email" id="email" class="bg-[#282626] border border-[#E3FC61] text-[#E3FC61] text-sm rounded-lg focus:ring-[#E3FC61] focus:border-[#E3FC61] block w-full p-2.5 " placeholder="name@gmail.com" required />
          </div>
          <div>
              <label for="password" class="block mb-2 text-sm font-bold text-[#E3FC61]">Your password</label>
              <input type="password" name="password" id="password" placeholder="••••••••" class="bg-[#282626] border border-[#E3FC61] text-[#E3FC61] text-sm rounded-lg focus:ring-[#E3FC61] focus:border-[#E3FC61] block w-full p-2.5" required />
          </div>
          <button type="submit" class="w-full text-[#FF663D] bg-[#E3FC61] hover:bg-[#efffa0] focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login account</button>
          <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
          </div>
      </form>
    </div>
  </section>

</x-layout>