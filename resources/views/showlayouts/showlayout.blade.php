<!DOCTYPE html>
<html lang="kr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tailwind CSS Layout</title>
  <!-- Tailwind CSS CDN (if you don't have it installed locally) -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet"> -->
  @vite(['resources/css/app.css', 'esources/js/app.js'])

</head>
<body class="h-screen">
  <!-- Header -->
  <header class="bg-white p-4">
    <div class= "flex items=center">
        <h1 class="text-xl font-bold pl-32 italic">
            @yield('session_name')
        </h1>
        <small class="pl-8 p-2 pt-1 text-xs">@yield('type')</small>
    </div>
  </header>

  <!-- Main Content -->
  <div class="flex h-full">
    <!-- Sidebar -->
    <aside class="w-1/5 bg-white text-center ">
      <h2 class="text-lg font-semibold mb-2 border-y-2  pt-52">Sidebar</h2>
      // 이 부분 뭐 카테고리 불러와도  될듯함
      <ul>
        <li class="mb-1"><a href="#" class="text-blue-500 hover:underline">Home</a></li>
        <li class="mb-1"><a href="#" class="text-blue-500 hover:underline">About</a></li>
        <li class="mb-1"><a href="#" class="text-blue-500 hover:underline">Services</a></li>
        <li class="mb-1"><a href="#" class="text-blue-500 hover:underline">Contact</a></li>
      </ul>
    </aside>

    <!-- Main Content Area -->
    <main class="w-3/5 bg-white">
    <div class="bg-gray-100 p-4 h-20">
      <h2 class="text-xl font-bold mb-4 text-center">@yield('title1')</h2>
      
    </div>
    <div class="p-16">
        @yield('qq')
    </div>
    </main>
  </div>

  <!-- Footer -->
  <footer class="bg-white text-gray-400 p-10 mt-4 border-t-2 text-xs">
    &copy; 2023 My Website. All rights reserved.
  </footer>
</body>
</html>