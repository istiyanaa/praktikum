<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arsip Kepegawaian</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Untuk Load Navbar -->
    @include('layouts.partials.navbar')

    <!-- Untuk Load Sidebar -->
    @include('layouts.partials.sidebar')

    <!-- Untuk Load Content Wrapper -->
    <div class="content-wrapper">
        {{ $slot }}
    </div>

   

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@livewireScripts
</body>
</html>
