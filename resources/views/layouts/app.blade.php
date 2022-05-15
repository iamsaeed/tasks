<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="h-full">
<div class="min-h-full" id="app">
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                        <!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
                        <a href="{{route('home')}}" class=" @if (url()->current() == route('home')) border-indigo-500 @else border-transparent @endif text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm" aria-current="page"> Dashboard </a>
                        <a href="{{route('projects')}}" class=" @if (url()->current() == route('projects')) border-indigo-500 @else border-transparent @endif  text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm"> Projects </a>
                        <a href="{{route('task.statuses')}}" class="@if (url()->current() == route('task.statuses')) border-indigo-500 @else border-transparent @endif text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm"> Task Statuses </a>
                    </div>
                </div>
                <div class="flex items-center sm:ml-6 sm:flex sm:items-center">
                    <!-- Profile dropdown -->
                    <div class="ml-3 relative">
                        <div class=" sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            href="#"
                            class="@if (url()->current() == route('logout')) border-indigo-500 @else border-transparent @endif text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="-mr-2 flex items-center sm:hidden"></div>
            </div>
        </div>
    </nav>

    <div class="py-5">
        <main>
           <div class="max-w-5xl mx-auto px-5">@yield('content')</div>
        </main>
    </div>
</div>
</body>
</html>
