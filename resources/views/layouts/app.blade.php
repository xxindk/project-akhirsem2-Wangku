<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Wangku - Pengatur Keuangan Pribadi</title>
    <link href="" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <header class="flex justify-between p-4 bg-white shadow">
        <div class="flex items-center space-x-2">
           
        </div>
        <div>
           
        </div>
    </header>

    <main class="mt-8">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @stack('scripts')

</body>
</html>
