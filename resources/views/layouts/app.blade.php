<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TTG Shop')</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-stone-50 text-stone-900">
    <header class="border-b border-stone-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
            <a href="{{ route('home') }}" class="text-2xl font-black tracking-tight text-stone-950">TTG Shop<span class="text-amber-600">.</span></a>
            <nav class="hidden items-center gap-7 text-sm font-medium md:flex">
                <a class="hover:text-amber-600" href="{{ route('home') }}">Trang chủ</a>
                <a class="hover:text-amber-600" href="{{ route('about') }}">Giới thiệu</a>
                <a class="hover:text-amber-600" href="{{ route('contact') }}">Liên hệ</a>
                @auth
                    @if(auth()->user()->role === 'owner')
                        <a class="hover:text-amber-600" href="{{ route('owner.dashboard') }}">Quản trị</a>
                    @endif
                    <a class="hover:text-amber-600" href="{{ route('profile') }}">Xin chào, {{ auth()->user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-full bg-stone-900 px-4 py-2 text-white hover:bg-amber-700" type="submit">Đăng xuất</button>
                    </form>
                @else
                    <a class="hover:text-amber-600" href="{{ route('login') }}">Đăng nhập</a>
                    <a class="rounded-full bg-stone-900 px-4 py-2 text-white hover:bg-amber-700" href="{{ route('register') }}">Đăng ký</a>
                @endauth
            </nav>
            <details class="relative md:hidden">
                <summary class="cursor-pointer list-none rounded-lg border border-stone-300 px-3 py-2">Menu</summary>
                <div class="absolute right-0 z-10 mt-2 w-48 space-y-2 rounded-xl bg-white p-4 shadow-xl">
                    <a class="block" href="{{ route('home') }}">Trang chủ</a>
                    <a class="block" href="{{ route('about') }}">Giới thiệu</a>
                    <a class="block" href="{{ route('contact') }}">Liên hệ</a>
                    @auth
                        <a class="block" href="{{ route('profile') }}">Hồ sơ</a>
                    @else
                        <a class="block" href="{{ route('login') }}">Đăng nhập</a>
                    @endauth
                </div>
            </details>
        </div>
    </header>
    @if(session('success'))
        <div class="mx-auto mt-5 max-w-7xl px-6"><div class="rounded-xl bg-emerald-100 px-4 py-3 text-emerald-800">{{ session('success') }}</div></div>
    @endif
    <main>@yield('content')</main>
    <footer class="mt-20 border-t border-stone-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-6 py-8 text-sm text-stone-500 md:flex-row md:justify-between">
            <span>© {{ date('Y') }} TTG Shop. Mặc đẹp, sống chất.</span>
            <span>Thời trang dành cho phong cách riêng của bạn.</span>
        </div>
    </footer>
</body>
</html>
