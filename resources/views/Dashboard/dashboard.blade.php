<x-layout>
  <x-navigate.sidebar></x-navigate.sidebar>
  
  <section class="flex items-center justify-center h-screen ml-64">
    <div class="w-full max-w-sm bg-[#0D0D0D] border border-gray-200 rounded-lg shadow-sm">
        <div class="flex flex-col items-center py-10">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Welcome Dashboard</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->name }}</span>
            <div class="flex mt-4 md:mt-6">
              <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-center text-[#0D0D0D] bg-[#A6FF00] rounded-lg hover:bg-[#9CF268] focus:ring-4 focus:outline-none focus:ring-[#9CF268]">
                Log Out
                <svg class="w-6 h-6 text-[#0D0D0D]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                </svg>
              </button>
              </form>
            </div>
        </div>
    </div>
  </section>


</x-layout>