{{-- resources/views/blog/admin.blade.php --}}
@extends('layouts.app')

@section('title', 'Адміністрування блогу')

@section('content')
    <div style="background-color: #ffffff; padding: 24px; border-radius: 10px; border: 1px solid #ddd;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
            <h1 style="margin: 0; font-size: 26px; color: #0a3622;">
                Адміністрування публікацій
            </h1>

            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <a
                    href="{{ route('blog.index') }}"
                    style="padding: 8px 14px; border: 1px solid #6c757d; border-radius: 6px; color: #333; text-decoration: none; font-size: 14px; background-color: #f8f9fa;"
                >
                    До карток
                </a>
                <a
                    href="{{ route('blog.create') }}"
                    style="padding: 8px 14px; border-radius: 6px; color: #ffffff; text-decoration: none; font-size: 14px; font-weight: bold; background-color: #1f8135;"
                >
                    + Додати новий запис
                </a>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                <tr style="background-color: #0a3622; color: #ffffff; text-align: left;">
                    <th style="padding: 12px; border: 1px solid #0a3622; width: 50px;">#</th>
                    <th style="padding: 12px; border: 1px solid #0a3622;">Заголовок (UA)</th>
                    <th style="padding: 12px; border: 1px solid #0a3622; width: 180px;">Категорія</th>
                    <th style="padding: 12px; border: 1px solid #0a3622; width: 150px;">Створено</th>
                    <th style="padding: 12px; border: 1px solid #0a3622; width: 190px;">Дії</th>
                </tr>
                </thead>
                <tbody>
                @forelse($blogs as $i => $blog)
                    <tr style="background-color: {{ $loop->even ? '#f8f9fa' : '#ffffff' }};">
                        <td style="padding: 10px 12px; border: 1px solid #dee2e6;">
                            {{ $blogs->firstItem() + $i }}
                        </td>
                        <td style="padding: 10px 12px; border: 1px solid #dee2e6;">
                            <a
                                href="{{ route('blog.show', $blog) }}"
                                style="font-weight: bold; color: #0a3622; text-decoration: none;"
                            >
                                {{ $blog->title }}
                            </a>
                        </td>
                        <td style="padding: 10px 12px; border: 1px solid #dee2e6;">
                                <span style="display: inline-block; padding: 3px 8px; border-radius: 4px; background-color: #e8f5e9; color: #1f8135; font-size: 12px; font-weight: bold;">
                                    {{ $blog->category?->category_name ?? 'Без категорії' }}
                                </span>
                        </td>
                        <td style="padding: 10px 12px; border: 1px solid #dee2e6; color: #555;">
                            {{ $blog->dt_created?->format('d.m.Y H:i') }}
                        </td>
                        <td style="padding: 10px 12px; border: 1px solid #dee2e6;">
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <a
                                    href="{{ route('blog.edit', $blog) }}"
                                    style="padding: 5px 10px; border-radius: 4px; background-color: #ffc107; color: #212529; text-decoration: none; font-size: 13px; font-weight: bold;"
                                >
                                    Редагувати
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('blog.destroy', $blog) }}"
                                    onsubmit="return confirm('Видалити цей запис?');"
                                    style="margin: 0;"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        style="padding: 5px 10px; border: none; border-radius: 4px; background-color: #dc3545; color: #ffffff; font-size: 13px; cursor: pointer;"
                                    >
                                        Видалити
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 16px; border: 1px solid #dee2e6; text-align: center; color: #666;">
                            Записів немає.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 16px;">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection
