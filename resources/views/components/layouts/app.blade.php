<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title')</title>
    @livewireStyles
</head>

<body>

    <div style="display: flex;">
        <nav style="width: 200px; background-color: #f0f0f0; padding: 20px;">
            <ul style="list-style-type: none; padding: 0;">
                <li><a href="{{ route('barangs') }}">Barang</a></li>
                <li><a href="{{ route('mutasi-masuk') }}">Mutasi Masuk</a></li>
                <li><a href="{{ route('mutasi-keluar') }}">Mutasi Keluar</a></li>
                <li><a href="#">Perpindahan Inventaris</a></li>
            </ul>
        </nav>

        <div style="flex-grow: 1;">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
</body>

</html>
