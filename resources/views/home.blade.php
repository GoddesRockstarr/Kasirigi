<!DOCTYPE html>
<html lang="en">
    @extends('layouts.main')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
   
</head>
<body>
    <x-header></x-header>
    <x-navbar></x-navbar> <!-- Sidebar included here -->
    <div class="container mt-4">
        <!-- Add your home page content here -->
        <h1>Welcome to Kasirigi</h1>    
    </div>

    <x-footer></x-footer>

    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/horizontal-layout.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>
</body>
</html>