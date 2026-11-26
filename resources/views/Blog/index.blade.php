
@extends('layouts.app')

@php
    $currentLang = $lang ?? request('lang', 'uk');
@endphp

@section('title', $currentLang === 'en' ? 'Auto News & Service Blog' : 'Новини та блог автосервісу')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
        <h1 style="margin: 0; font-size: 28px; color: #0a3622;">
            {{ $currentLang === 'en' ? 'Auto News & Service Blog' : 'Новини та блог автосервісу' }}
        </h1>

        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <a
                href="{{ route('blog.admin') }}"
                style="padding: 8px 14px; border: 1px solid #0a3622; border-radius: 6px; color: #0a3622; text-decoration: none; font-size: 14px; background-color: #ffffff;"
            >
                {{ $currentLang === 'en' ? 'Admin Panel' : 'Панель адміністрування' }}
            </a>

            <div style="display: inline-flex; border: 1px solid #1f8135; border-radius: 6px; overflow: hidden;">
                <a
                    href="{{ route('blog.index', ['lang' => 'uk']) }}"
                    style="padding: 8px 12px; text-decoration: none; font-size: 13px; font-weight: bold; {{ $currentLang === 'uk' ? 'background-color: #1f8135; color: #ffffff;' : 'background-color: #ffffff; color: #1f8135;' }}"
                >
                    UA
                </a>
                <a
                    href="{{ route('blog.index', ['lang' => 'en']) }}"
                    style="padding: 8px 12px; text-decoration: none; font-size: 13px; font-weight: bold; {{ $currentLang === 'en' ? 'background-color: #1f8135; color: #ffffff;' : 'background-color: #ffffff; color: #1f8135;' }}"
                >
                    EN
                </a>
            </div>
        </div>
    </div>

    <div class="blog-grid">
        @forelse($blogs as $blog)
            @include('blog._item', ['blog' => $blog, 'lang' => $currentLang])
        @empty
            <p style="color: #666;">
                {{ $currentLang === 'en' ? 'No posts yet.' : 'Записів поки немає.' }}
            </p>
        @endforelse
    </div>

    <style>
        .custom-pagination svg {
            width: 16px;
            height: 16px;
            display: inline-block;
            vertical-align: middle;
        }
        .custom-pagination nav > div:first-child {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        .custom-pagination nav > div:last-child {
            display: none;
        }
        .custom-pagination a,
        .custom-pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 14px;
            border-radius: 6px;
            border: 1px solid #1f8135;
            font-size: 14px;
            text-decoration: none;
            color: #1f8135;
            background-color: #ffffff;
        }
        .custom-pagination a:hover {
            background-color: #1f8135;
            color: #ffffff;
        }
        .custom-pagination span[aria-disabled="true"] {
            opacity: 0.45;
            border-color: #ccc;
            color: #666;
        }
    </style>

    <div class="custom-pagination" style="margin-top: 24px;">
        {{ $blogs->links() }}
    </div>
@endsection
