
@php
    $en = isset($blog) ? $blog->translations->firstWhere('locale', 'en') : null;
@endphp

<div style="margin-bottom: 16px;">
    <label for="category_id" style="display: block; font-weight: bold; margin-bottom: 6px; color: #222;">
        Категорія
    </label>
    <select
        id="category_id"
        name="category_id"
        style="width: 100%; padding: 9px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; background-color: #fff; box-sizing: border-box;"
    >
        <option value="">- Без категорії -</option>
        @foreach($categories as $id => $name)
            <option value="{{ $id }}" @selected(old('category_id', $blog->category_id ?? '') == $id)>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
    <div style="color: #dc3545; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
    @enderror
</div>

<h3 style="margin: 24px 0 14px 0; padding-bottom: 8px; border-bottom: 2px solid #0a3622; color: #0a3622; font-size: 18px;">
    Основний контент (Українська мова)
</h3>

<div style="margin-bottom: 16px;">
    <label for="title" style="display: block; font-weight: bold; margin-bottom: 6px; color: #222;">
        Заголовок (UA) *
    </label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $blog->title ?? '') }}"
        required
        style="width: 100%; padding: 9px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box;"
    >
    @error('title')
    <div style="color: #dc3545; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
    @enderror
</div>

<div style="margin-bottom: 16px;">
    <label for="description" style="display: block; font-weight: bold; margin-bottom: 6px; color: #222;">
        Короткий опис (UA)
    </label>
    <textarea
        id="description"
        name="description"
        rows="2"
        style="width: 100%; padding: 9px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; font-family: inherit; box-sizing: border-box;"
    >{{ old('description', $blog->description ?? '') }}</textarea>
    @error('description')
    <div style="color: #dc3545; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
    @enderror
</div>

<div style="margin-bottom: 16px;">
    <label for="text" style="display: block; font-weight: bold; margin-bottom: 6px; color: #222;">
        Повний текст (UA)
    </label>
    <textarea
        id="text"
        name="text"
        rows="5"
        style="width: 100%; padding: 9px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; font-family: inherit; box-sizing: border-box;"
    >{{ old('text', $blog->text ?? '') }}</textarea>
    @error('text')
    <div style="color: #dc3545; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
    @enderror
</div>

<h3 style="margin: 24px 0 14px 0; padding-bottom: 8px; border-bottom: 2px solid #1f8135; color: #1f8135; font-size: 18px;">
    Переклад (English — Індивідуальне завдання)
</h3>

<div style="margin-bottom: 16px;">
    <label for="en_title" style="display: block; font-weight: bold; margin-bottom: 6px; color: #222;">
        Title (EN)
    </label>
    <input
        type="text"
        id="en_title"
        name="en_title"
        value="{{ old('en_title', $en->title ?? '') }}"
        style="width: 100%; padding: 9px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box;"
    >
    @error('en_title')
    <div style="color: #dc3545; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
    @enderror
</div>

<div style="margin-bottom: 16px;">
    <label for="en_description" style="display: block; font-weight: bold; margin-bottom: 6px; color: #222;">
        Short Description (EN)
    </label>
    <textarea
        id="en_description"
        name="en_description"
        rows="2"
        style="width: 100%; padding: 9px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; font-family: inherit; box-sizing: border-box;"
    >{{ old('en_description', $en->description ?? '') }}</textarea>
    @error('en_description')
    <div style="color: #dc3545; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
    @enderror
</div>

<div style="margin-bottom: 16px;">
    <label for="en_text" style="display: block; font-weight: bold; margin-bottom: 6px; color: #222;">
        Full Text (EN)
    </label>
    <textarea
        id="en_text"
        name="en_text"
        rows="5"
        style="width: 100%; padding: 9px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; font-family: inherit; box-sizing: border-box;"
    >{{ old('en_text', $en->text ?? '') }}</textarea>
    @error('en_text')
    <div style="color: #dc3545; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="works_select" class="form-label">Роботи СТО</label>
    <select id="works_select" name="repair_works[]" class="form-select" multiple>
        @foreach ($repairWorks ?? [] as $id => $title)
            <option value="{{ $id }}" @selected(in_array($id, old('repair_works', $selectedWorks ?? [])))>
                {{ $title }}
            </option>
        @endforeach
    </select>
    @error('repair_works')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
    @error('repair_works.*')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>
