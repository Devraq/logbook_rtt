<!-- resources/views/layouts/admin.blade.php -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'Logbook')</title>
  @vite(['resources/css/app.css','resources/js/logbook.js'])
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="min-h-screen flex">
    <aside class="w-72 bg-white border-r p-4">
      <h1 class="text-xl font-bold mb-4">Logbook — PIBT</h1>
      <nav>
        <a href="{{ route('logbook.index') }}" class="block py-2 px-3 rounded hover:bg-gray-100">Dashboard</a>
      </nav>
    </aside>

    <main class="flex-1 p-6">
      @yield('content')
    </main>
  </div>
</body>
</html>
