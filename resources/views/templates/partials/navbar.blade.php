{{-- navbar --}}
<nav class="fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
      <div class="flex items-center justify-between">

        <div class="flex items-center space-x-8">
          <div class="shrink-0">
            <a href="#" class="">
              <img class="block w-auto h-8 dark:hidden" src="/logo/logo.png" alt="">
              <img class="hidden w-auto h-8 dark:block" src="/logo/logo.png" alt="">
            </a>
          </div>

          <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
            <li>
              <a href="/" class="flex text-sm font-medium {{ request()->is('/') ? 'text-orange-500 dark:text-orange-500' : 'text-gray-900 dark:text-white' }} hover:text-orange-500">
                Home
              </a>
            </li>
            <li class="shrink-0">
              <a href="/#category" class="flex text-sm font-medium text-gray-900 hover:text-orange-500 dark:text-white">
                Kategori
              </a>
            </li>
            <li class="shrink-0">
              <a href="/products" class="flex text-sm font-medium  {{ request()->is('products*') ? 'text-orange-500 dark:text-orange-500' : 'text-gray-900 dark:text-white' }} hover:text-orange-500">
                Produk
              </a>
            </li>
          </ul>
        </div>

        <div class="flex items-center lg:space-x-2">
            @auth
            @include('templates.partials.cart-menu')
            @include('templates.partials.user-menu')
            @else
            <a href="/login" class="text-gray-500 dark:text-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">Login</a>
            @endauth

            <button type="button" data-collapse-toggle="ecommerce-navbar-menu-1" aria-controls="ecommerce-navbar-menu-1" aria-expanded="false" class="inline-flex lg:hidden items-center justify-center hover:bg-gray-100 rounded-md dark:hover:bg-gray-700 p-2 text-gray-900 dark:text-white">
                <span class="sr-only">
                Open Menu
                </span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                </svg>
            </button>
        </div>
      </div>

      <div id="ecommerce-navbar-menu-1" class="bg-gray-50 dark:bg-gray-700 dark:border-gray-600 border border-gray-200 rounded-lg py-3 hidden px-4 mt-4">
        <ul class="text-gray-900 dark:text-white text-sm font-medium dark:text-white space-y-3">
          <li>
            <a href="/" class="{{ request()->is('/') ? 'text-orange-500' : '' }} hover:text-orange-500">Home</a>
          </li>
          <li>
            <a href="/#category" class="hover:text-orange-500">Kategori</a>
          </li>
          <li>
            <a href="/products" class="{{ request()->is('products*') ? 'text-orange-500' : '' }} hover:text-orange-500">Produk</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
{{-- end navbar --}}
