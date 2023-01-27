<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/c34ef532b6.js" crossorigin="anonymous"></script>
  @vite('resources/css/app.css')
  <title>LaraBook | @yield('title')</title>
</head>

<body>
  <div id="main" class="min-h-screen flex flex-col">
    {{-- Navbar --}}
    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-gray-900">
      <div class="container flex flex-wrap items-center justify-between mx-auto">
        <a href="https://flowbite.com/" class="flex items-center">
          {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-9" alt="Flowbite Logo" /> --}}
          <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">LaraBook</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
          class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="navbar-default" aria-expanded="false" id="btn-collapse">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
    </nav>
    {{-- End Navbar --}}
    {{-- Content --}}
    <div class="min-h-screen flex flex-wrap">
      {{-- Sidebar --}}
      <div class="bg-[#202E4B] w-full hidden lg:w-[15%] lg:min-h-full lg:block" id="target">
        <div class="bg-[#202E4B] border-gray-600 text-white">
          @if (Auth::user())
          {{-- SIDEBAR ADMIN --}}
          @if (Auth::user()->role_id == 1)
          <a href="/dashboard"
            class="inline-flex relative items-center py-2 px-4 w-full text-sm font-medium border-b border-t border-gray-600 hover:bg-gray-600 @if(request()->route()->uri == 'dashboard') bg-gray-900 border-r-8 border-r-orange-600 @endif">
            <div class="w-6">
              <i class="fas fa-chalkboard"></i>
            </div>
            <span>Dashboard</span>
          </a>
          <a href="/books"
            class="inline-flex relative items-center py-2 px-4 w-full text-sm font-medium border-b border-gray-600 hover:bg-gray-600 @if(request()->route()->uri == 'books') bg-gray-900 border-r-8 border-r-orange-600 @endif">
            <div class="w-6">
              <i class="fas fa-book mr-2"></i>
            </div>
            <span>Books</span>
          </a>
          <a href="/categories"
            class="inline-flex relative items-center py-2 px-4 w-full text-sm font-medium border-b border-gray-600 hover:bg-gray-600 @if(request()->route()->uri == 'categories') bg-gray-900 border-r-8 border-r-orange-600 @endif">
            <div class="w-6">
              <i class="fas fa-list mr-2"></i>
            </div>
            <span>Categories</span>
          </a>
          <a href="/users"
            class="inline-flex relative items-center py-2 px-4 w-full text-sm font-medium border-b border-gray-600 hover:bg-gray-600 @if(request()->route()->uri == 'users') bg-gray-900 border-r-8 border-r-orange-600 @endif">
            <div class="w-6">
              <i class="fas fa-users mr-2"></i>
            </div>
            <span>Users</span>
          </a>
          <a href="/rent-logs"
            class="inline-flex relative items-center py-2 px-4 w-full text-sm font-medium border-b border-gray-600 hover:bg-gray-600 @if(request()->route()->uri == 'rent-logs') bg-gray-900 border-r-8 border-r-orange-600 @endif">
            <div class="w-6">
              <i class="fas fa-clipboard-list mr-2"></i>
            </div>
            <span>Rent Logs</span>
          </a>
          <a href="/logout"
            class="inline-flex relative items-center py-2 px-4 w-full text-sm font-medium border-b border-gray-600 hover:bg-gray-600">
            <div class="w-6">
              <i class="fas fa-sign-out mr-2"></i>
            </div>
            <span>Log Out</span>
          </a>
          {{-- END SIDEBAR ADMIN --}}

          {{-- SIDEBAR CLIENT --}}
          @else
          <a href="/profile"
            class="inline-flex relative items-center py-2 px-4 w-full text-sm font-medium border-b border-gray-600 hover:bg-gray-600 @if(request()->route()->uri == 'profile') bg-gray-900 border-r-8 border-r-orange-600 @endif">
            <div class="w-6">
              <i class="fas fa-user mr-2"></i>
            </div>
            <span>Profile</span>
          </a>
          <a href="/"
            class="inline-flex relative items-center py-2 px-4 w-full text-sm font-medium border-b border-gray-600 hover:bg-gray-600 @if(request()->route()->uri == '/') bg-gray-900 border-r-8 border-r-orange-600 @endif">
            <div class="w-6">
              <i class="fas fa-book mr-2"></i>
            </div>
            <span>Books</span>
          </a>
          <a href="/rent-logs"
            class="inline-flex relative items-center py-2 px-4 w-full text-sm font-medium border-b border-gray-600 hover:bg-gray-600 @if(request()->route()->uri == 'rent-logs') bg-gray-900 border-r-8 border-r-orange-600 @endif">
            <div class="w-6">
              <i class="fas fa-clipboard-list mr-2"></i>
            </div>
            <span>Rent Logs</span>
          </a>
          <a href="/logout"
            class="inline-flex relative items-center py-2 px-4 w-full text-sm font-medium border-b border-gray-600 hover:bg-gray-600">
            <div class="w-6">
              <i class="fas fa-sign-out mr-2"></i>
            </div>
            <span>Log Out</span>
          </a>
          @endif
          {{-- END SIDEBAR CLIENT --}}
          @else
          <a href="/login"
            class="inline-flex relative items-center py-2 px-4 w-full text-sm font-medium border-b border-gray-600 hover:bg-gray-600">
            <div class="w-6">
              <i class="fas fa-sign-out mr-2"></i>
            </div>
            <span>Login</span>
          </a>
          @endif

        </div>
      </div>
      {{-- End Sidebar --}}

      {{-- Main Content --}}
      <div class="h-screen w-[85%] p-10 border-2 border-black overflow-hidden">
        @yield('content')
      </div>
      {{-- End Main Content --}}
    </div>
    {{-- End Content --}}
  </div>
  <script>
    $(function() {
      $('#btn-collapse').click(() => {
        $("#target").slideToggle();
      });
    });
  </script>
</body>

</html>