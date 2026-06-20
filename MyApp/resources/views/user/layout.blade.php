<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@vite(['resources/css/app.css','resources/js/app.js'])
<title>User Dashboard</title>
</head>
<body class="bg-gray-50">


  <div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
      <div class="p-6 text-2xl font-bold border-b border-gray-800">
        <span class="text-indigo-400">User</span>Panel
      </div>
      <nav class="flex-1 p-4 space-y-3">
        <a href="{{ route('user.dashboard') }}" title="Dashboard" class="block py-2 px-3 rounded hover:bg-gray-800">🏠 Dashboard</a>
        <a href="{{ route('annonces.create') }}" title="Create ad" class="block py-2 px-3 rounded hover:bg-gray-800">➕ Create ad</a>
        <a href="{{ route('profile.edit') }}" title="profile" class="block py-2 px-3 rounded hover:bg-gray-800">⚙️ Profile</a> 
      </nav>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">

      <!-- Header -->
      <header class="bg-white shadow flex justify-between items-center px-6 py-4">
        <h1 class="text-xl font-semibold"> {{ auth()->user()->name }}'s Dashboard</h1>

        <!-- Dropdown -->
        <div class="relative">
          <button onclick="toggleDropdown()" class="flex items-center space-x-2 bg-gray-100 px-3 py-2 rounded hover:bg-gray-200">
            <img src="https://i.pravatar.cc/40" alt="user" class="w-8 h-8 rounded-full">
            <span>{{ auth()->user()->name }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <!-- Dropdown Menu -->
          <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
            <hr>
            
            <form method="POST" action="{{ route('logout') }}">
              @csrf
                <button type="submit" class="block px-4 py-2 hover:bg-gray-100">
                    logout
                  </button>
            </form>
          </div>
        </div>
      </header>
           
                  @yield('content')
      </div>
      </div>

       <script>
    // Simple dropdown toggle
    function toggleDropdown() {
      document.getElementById('dropdownMenu').classList.toggle('hidden');
    }
  </script>



</body>
</html>