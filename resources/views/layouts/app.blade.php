<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arsip Kepegawaian</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <!-- Di bagian head atau sebelum closing body -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body  class="hold-transition sidebar-mini">
     <div class="wrapper">
        @include('layouts.partials.navbar')

        @include('layouts.partials.sidebar')


    <div class="content-wrapper">

        {{ $slot }}

    </div>

    @include('layouts.partials.footer')
    </div>

@livewireScripts
</body>
</html>
