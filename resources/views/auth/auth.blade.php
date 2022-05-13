<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="h-full">
<div class="min-h-full">
    <header class="relative">
        <div class="bg-warm-gray-50">
            <nav class="relative max-w-7xl mx-auto flex items-center justify-between pt-6 px-6 xl:px-8" aria-label="Global">
                <div class="flex items-center flex-1">
                    <div class="hidden space-x-10 lg:flex lg:ml-10">
                    </div>
                </div>
                <div class="hidden lg:flex lg:items-center lg:space-x-6">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="py-2 px-6 bg-warm-gray-100 border border-transparent rounded-md text-base font-medium text-warm-gray-900 hover:bg-warm-gray-200"> {{ __('Login') }} </a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="py-2 px-6 bg-warm-gray-100 border border-transparent rounded-md text-base font-medium text-warm-gray-900 hover:bg-warm-gray-200"> {{ __('Register') }} </a>
                        @endif
                    @else

                    @endguest
                </div>
            </nav>
        </div>
    </header>

    <div class="py-0">
        @yield('content')
    </div>
</div>

</body>
</html>
