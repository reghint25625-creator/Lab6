@php
    $currentLang = $lang ?? request('lang', 'uk');
@endphp

<article class="blog-card" style="display: flex; flex-direction: column;">
    <a href="{{ route('blog.show', [$blog, 'lang' => $currentLang]) }}">
        <img
            src="{{ asset('images/blog-placeholder.jpg') }}"
            alt="{{ $blog->getTranslatedAttribute('title', $currentLang) }}"
            class="blog-card-image"
        >
    </a>

    <div class="blog-card-body" style="display: flex; flex-direction: column; flex: 1;">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-bottom: 8px;">
            <span class="blog-category">
                {{ $blog->category?->category_name ?? 'Без категорії' }}
            </span>
            <span class="blog-meta">
                {{ $blog->dt_created?->format('d.m.Y') }}
            </span>
        </div>

        <h2 style="margin: 0 0 10px 0; font-size: 19px; line-height: 1.3;">
            <a href="{{ route('blog.show', [$blog, 'lang' => $currentLang]) }}" style="color: #111; text-decoration: none;">
                {{ $blog->getTranslatedAttribute('title', $currentLang) }}
            </a>
        </h2>

        <p style="margin: 0 0 16px 0; color: #444; font-size: 14px; line-height: 1.5; flex: 1;">
            {{ \Illuminate\Support\Str::limit($blog->getTranslatedAttribute('description', $currentLang) ?? '', 120) }}
        </p>

        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 10px; border-top: 1px solid #eee; gap: 8px;">
            <span class="blog-meta">
                Автор: {{ $blog->author?->name ?? 'Редакція' }}
            </span>
            <a
                href="{{ route('blog.show', [$blog, 'lang' => $currentLang]) }}"
                style="color: #1f8135; font-size: 14px; font-weight: bold; text-decoration: none;"
            >
                {{ $currentLang === 'en' ? 'Read more →' : 'Читати далі →' }}
            </a>
        </div>
    </div>

    <div class="mt-2">
        @if ($blog->repair_works_count > 0)
            <small class="text-muted">
                Роботи СТО ({{ $blog->repair_works_count }}):
                @foreach ($blog->repairWorks as $work)
                    <span class="badge bg-secondary">{{ $work->title }}</span>
                @endforeach
            </small>
        @else
            <small class="text-muted">Роботи СТО не вказано</small>
        @endif
    </div>
</article>
