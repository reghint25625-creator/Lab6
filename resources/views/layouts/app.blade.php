<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Лабораторний практикум — СТО')</title>

    @vite(['resources/js/app.js'])

    <style>
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin: 24px 0;
        }
        .blog-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            background-color: #ffffff;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }
        .blog-card-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }
        .blog-card-body {
            padding: 16px;
        }
        .blog-category {
            font-size: 13px;
            color: #1f8135;
            font-weight: bold;
        }
        .blog-meta {
            font-size: 13px;
            color: #666;
        }
        .pagination {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 20px;
        }
        .pagination .disabled {
            color: #999;
        }

        /* Раскладка DualListBox без сетки Bootstrap */
        .bootstrap-duallistbox-container {
            display: flex;
            gap: 20px;
            max-width: 720px;
        }
        .bootstrap-duallistbox-container .box1,
        .bootstrap-duallistbox-container .box2 {
            flex: 1;
            min-width: 0;
        }
        .bootstrap-duallistbox-container select {
            width: 100%;
            height: 190px;
        }
    </style>
    @stack('styles')
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; display: flex; flex-direction: column; min-height: 100vh;">

<!-- Навигация -->
<nav style="background-color: #0a3622; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
    <div style="color: white; font-size: 18px; font-weight: bold;">
        🚗 <span>Автомайстерня «AutoService»</span>
    </div>

    <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 14px;">
        <a href="{{ route('home') }}" style="color: white; text-decoration: none; font-weight: bold;">Головна</a>
        <a href="{{ route('services.index') }}" style="color: white; text-decoration: none;">Послуги</a>
        <a href="{{ route('blog.index') }}" style="color: white; text-decoration: none; {{ request()->routeIs('blog.*') ? 'text-decoration: underline; font-weight: bold;' : '' }}">Блог / Новини</a>
        <a href="{{ route('about') }}" style="color: white; text-decoration: none;">Про застосунок</a>
        <a href="{{ route('contact') }}" style="color: white; text-decoration: none;">Контакти</a>
        <a href="{{ route('stats.pages') }}" style="color: white; text-decoration: none;">Статистика відвідувань</a>
        <a href="{{ route('stats.services') }}" style="color: white; text-decoration: none;">Аналітика послуг</a>

        @auth
            <a href="{{ route('blog.admin') }}" style="color: #90ee90; text-decoration: none; font-weight: bold;">Адміністрування</a>
            <a href="{{ route('users.index') }}" style="color: #90ee90; text-decoration: none;">Користувачі</a>
            <a href="{{ route('profile.edit') }}" style="color: #ffffff; text-decoration: none;">Мій профіль</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0;">
                @csrf
                <button type="submit" style="padding: 5px 10px; border: 1px solid #ffffff; border-radius: 5px; background: transparent; color: #ffffff; cursor: pointer; font-size: 13px;">
                    Вийти ({{ auth()->user()->name }})
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" style="padding: 5px 10px; border: 1px solid #ffffff; border-radius: 5px; color: #ffffff; text-decoration: none; font-size: 13px;">Увійти</a>
            <a href="{{ route('register') }}" style="padding: 5px 10px; border-radius: 5px; background-color: #1f8135; color: #ffffff; text-decoration: none; font-size: 13px; font-weight: bold;">Реєстрація</a>
        @endguest
    </div>
</nav>

<!-- Основной контент -->
<main style="flex: 1; padding: 40px 20px; display: flex; justify-content: center; align-items: flex-start;">
    <div style="width: 100%; max-width: 1140px;">
        @if(session('success'))
            <div style="background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</main>

<!-- Подвал -->
<footer style="background-color: #1f8135; border-top: 2px solid #19e753; padding: 15px; text-align: center; color: white;">
    <div style="font-weight: bold; margin-bottom: 5px;">Автомайстерня / Сервісний центр СТО</div>
    &copy; {{ date('Y') }} КПІ ім. Ігоря Сікорського | Розробив: Красюков Іван Андрійович (Група РС-42, № 5)
</footer>

</body>
</html>
