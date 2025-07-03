<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kasir')</title>

    {{-- load style dari mazer --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="./assets/compiled/css/app.css">
  <link rel="stylesheet" href="publics/compiled/css/app-dark.css">
  <link rel="stylesheet" href="publics/compiled/css/iconly.css">

    <link rel="stylesheet" href="{{ asset('mazer/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/css/main/app-dark.css') }}">
    {{-- kalau pakai datatables bawaan --}}
    <link rel="stylesheet" href="{{ asset('mazer/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
</head>
<body>
    <div id="app">
      {{-- sidebar --}}
        <div id="main" class="layout-navbar">
          {{-- kalau punya header --}}
            <div id="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- javascript --}}
    <script src="{{ asset('mazer/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('mazer/assets/js/app.js') }}"></script>
    {{-- datatable --}}
    <script src="{{ asset('mazer/assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('mazer/assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('mazer/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('mazer/assets/js/pages/datatables.js') }}"></script>
</body>
</html>
