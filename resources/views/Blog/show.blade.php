@extends('layouts.app')

@php
    $currentLang = $lang ?? request('lang', 'uk');
@endphp

@section('title', $blog->getTranslatedAttribute('title', $currentLang))

@section('content')
    <div style="max-width: 900px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 16px;">
            <a
                href="{{ route('blog.index', ['lang' => $currentLang]) }}"
                style="padding: 7px 14px; border: 1px solid #6c757d; border-radius: 6px; background-color: #ffffff; color: #333; text-decoration: none; font-size: 14px;"
            >
                ← {{ $currentLang === 'en' ? 'Back to cards' : 'Назад до карток' }}
            </a>

            <div style="display: inline-flex; border: 1px solid #1f8135; border-radius: 6px; overflow: hidden;">
                <a
                    href="{{ route('blog.show', [$blog, 'lang' => 'uk']) }}"
                    style="padding: 7px 12px; text-decoration: none; font-size: 13px; font-weight: bold; {{ $currentLang === 'uk' ? 'background-color: #1f8135; color: #ffffff;' : 'background-color: #ffffff; color: #1f8135;' }}"
                >
                    UA
                </a>
                <a
                    href="{{ route('blog.show', [$blog, 'lang' => 'en']) }}"
                    style="padding: 7px 12px; text-decoration: none; font-size: 13px; font-weight: bold; {{ $currentLang === 'en' ? 'background-color: #1f8135; color: #ffffff;' : 'background-color: #ffffff; color: #1f8135;' }}"
                >
                    EN
                </a>
            </div>
        </div>

        <article style="background-color: #ffffff; padding: 28px; border-radius: 10px; border: 1px solid #ddd; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; margin-bottom: 12px;">
                <span style="display: inline-block; padding: 4px 10px; border-radius: 5px; background-color: #e8f5e9; color: #1f8135; font-size: 13px; font-weight: bold;">
                    {{ $blog->category?->category_name ?? 'Без категорії' }}
                </span>

                <span style="color: #666; font-size: 13px;">
                    {{ $blog->dt_created?->format('d.m.Y H:i') }}
                </span>
            </div>

            <h1 style="margin: 0 0 12px 0; font-size: 28px; line-height: 1.25; color: #0a3622;">
                {{ $blog->getTranslatedAttribute('title', $currentLang) }}
            </h1>

            @if(filled($blog->getTranslatedAttribute('description', $currentLang)))
                <p style="margin: 0 0 18px 0; font-size: 17px; line-height: 1.5; color: #555;">
                    {{ $blog->getTranslatedAttribute('description', $currentLang) }}
                </p>
            @endif

            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 18px 0;">

            <div style="font-size: 16px; line-height: 1.7; color: #222;">
                {!! nl2br(e($blog->getTranslatedAttribute('text', $currentLang) ?? '')) !!}
            </div>

            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 22px 0 14px 0;">

            <div style="color: #666; font-size: 13px;">
                Автор: {{ $blog->author?->name ?? 'Редакція' }}
            </div>
        </article>
    </div>
    @if ($blog->repairWorks->isNotEmpty())
        <div class="mb-3">
            @foreach ($blog->repairWorks as $work)
                <span class="badge bg-primary me-1">{{ $work->title }}</span>
            @endforeach
        </div>
    @endif

    <a href="{{ route('blog.works', $blog) }}" class="btn btn-sm btn-outline-secondary">
        Керувати роботами (DualListBox)
    </a>
@endsection
