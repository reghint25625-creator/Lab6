@extends('layouts.app')

@section('title', 'Редагування запису')

@section('content')
    <div style="max-width: 820px; margin: 0 auto; background-color: #ffffff; padding: 24px; border-radius: 10px; border: 1px solid #ddd;">
        <h1 style="margin: 0 0 20px 0; font-size: 26px; color: #0a3622;">
            Редагування запису #{{ $blog->blog_id }}
        </h1>

        <form method="POST" action="{{ route('blog.update', $blog) }}">
            @csrf
            @method('PUT')

            @include('blog._form')

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button
                    type="submit"
                    style="padding: 10px 18px; border: none; border-radius: 6px; background-color: #1f8135; color: #ffffff; font-size: 14px; font-weight: bold; cursor: pointer;"
                >
                    Оновити
                </button>

                <a
                    href="{{ route('blog.admin') }}"
                    style="padding: 10px 18px; border: 1px solid #6c757d; border-radius: 6px; background-color: #f8f9fa; color: #333; text-decoration: none; font-size: 14px;"
                >
                    Скасувати
                </a>
            </div>
        </form>
    </div>
@endsection
