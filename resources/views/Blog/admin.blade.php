{{-- resources/views/blog/admin.blade.php --}}
@extends('layouts.app')

@section('title', 'Адміністрування блогу')

@php
    $currentSort = request('sort');

    $sortUrl = function (string $field): string {
        $nextSort = request('sort') === $field ? '-' . $field : $field;

        return route('blog.admin', array_merge(
            request()->except('sort', 'page'),
            ['sort' => $nextSort]
        ));
    };

    $sortArrow = function (string $field) use ($currentSort): string {
        if ($currentSort === $field) {
            return ' ↑';
        }
        if ($currentSort === '-' . $field) {
            return ' ↓';
        }
        return '';
    };
@endphp

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

        {{-- Форма пошуку та фільтрації --}}
        <form
            method="GET"
            action="{{ route('blog.admin') }}"
            style="display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end; margin-bottom: 20px; padding: 14px; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px;"
        >
            <div style="display: flex; flex-direction: column; gap: 4px;">
                <label for="title" style="font-size: 12px; font-weight: bold; color: #333;">Заголовок</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ request('title') }}"
                    placeholder="Пошук за заголовком"
                    style="padding: 7px 10px; border: 1px solid #ced4da; border-radius: 6px; font-size: 14px;"
                >
            </div>

            <div style="display: flex; flex-direction: column; gap: 4px;">
                <label for="categoryName" style="font-size: 12px; font-weight: bold; color: #333;">Назва категорії</label>
                <input
                    type="text"
                    id="categoryName"
                    name="categoryName"
                    value="{{ request('categoryName') }}"
                    placeholder="Пошук за категорією"
                    style="padding: 7px 10px; border: 1px solid #ced4da; border-radius: 6px; font-size: 14px;"
                >
            </div>

            <div style="display: flex; flex-direction: column; gap: 4px;">
                <label for="category_id" style="font-size: 12px; font-weight: bold; color: #333;">Категорія</label>
                <select
                    id="category_id"
                    name="category_id"
                    onchange="this.form.submit()"
                    style="padding: 7px 10px; border: 1px solid #ced4da; border-radius: 6px; font-size: 14px; background-color: #ffffff;"
                >
                    <option value="">Усі категорії</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}" @selected((string) request('category_id') === (string) $id)>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; flex-direction: column; gap: 4px;">
                <label for="repair_work_id" style="font-size: 12px; font-weight: bold; color: #333;">Робота СТО</label>
                <select
                    id="repair_work_id"
                    name="repair_work_id"
                    onchange="this.form.submit()"
                    style="padding: 7px 10px; border: 1px solid #ced4da; border-radius: 6px; font-size: 14px; background-color: #ffffff;"
                >
                    <option value="">Усі роботи СТО</option>
                    @foreach($repairWorks as $id => $workTitle)
                        <option value="{{ $id }}" @selected((string) request('repair_work_id') === (string) $id)>
                            {{ $workTitle }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if(request()->filled('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif

            <div style="display: flex; gap: 8px; align-items: center;">
                <button
                    type="submit"
                    style="padding: 8px 14px; border: none; border-radius: 6px; background-color: #0a3622; color: #ffffff; font-size: 14px; font-weight: bold; cursor: pointer;"
                >
                    Застосувати
                </button>
                <a
                    href="{{ route('blog.admin') }}"
                    style="padding: 8px 12px; border: 1px solid #6c757d; border-radius: 6px; background-color: #ffffff; color: #333; text-decoration: none; font-size: 14px;"
                >
                    Скинути
                </a>
            </div>
        </form>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                <tr style="background-color: #0a3622; color: #ffffff; text-align: left;">
                    <th style="padding: 12px; border: 1px solid #0a3622; width: 50px;">#</th>
                    <th style="padding: 12px; border: 1px solid #0a3622;">
                        <a href="{{ $sortUrl('title') }}" style="color: #ffffff; text-decoration: none;">
                            Заголовок (UA){{ $sortArrow('title') }}
                        </a>
                    </th>
                    <th style="padding: 12px; border: 1px solid #0a3622; width: 180px;">
                        <a href="{{ $sortUrl('categoryName') }}" style="color: #ffffff; text-decoration: none;">
                            Категорія{{ $sortArrow('categoryName') }}
                        </a>
                    </th>
                    <th style="padding: 12px; border: 1px solid #0a3622; width: 220px;">Роботи СТО</th>
                    <th style="padding: 12px; border: 1px solid #0a3622; width: 120px;">
                        <a href="{{ $sortUrl('worksCount') }}" style="color: #ffffff; text-decoration: none;">
                            К-сть робіт{{ $sortArrow('worksCount') }}
                        </a>
                    </th>
                    <th style="padding: 12px; border: 1px solid #0a3622; width: 150px;">
                        <a href="{{ $sortUrl('created') }}" style="color: #ffffff; text-decoration: none;">
                            Створено{{ $sortArrow('created') }}
                        </a>
                    </th>
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
                        <td style="padding: 10px 12px; border: 1px solid #dee2e6;">
                            @forelse($blog->repairWorks as $work)
                                <span style="display: inline-block; margin: 2px 2px 2px 0; padding: 2px 7px; border-radius: 4px; background-color: #eef2f7; color: #1f2937; font-size: 12px;">
                                    {{ $work->title }}
                                </span>
                            @empty
                                <span style="color: #777; font-size: 12px;">Немає</span>
                            @endforelse
                        </td>
                        <td style="padding: 10px 12px; border: 1px solid #dee2e6; text-align: center; font-weight: bold;">
                            {{ $blog->repair_works_count }}
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
                        <td colspan="7" style="padding: 16px; border: 1px solid #dee2e6; text-align: center; color: #666;">
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
