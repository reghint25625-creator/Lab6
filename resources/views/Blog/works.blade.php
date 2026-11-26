@extends('layouts.app')

@section('title', 'Керування роботами СТО')

@section('content')
    <h1 class="mb-4">Роботи СТО для запису: {{ $blog->getTranslatedAttribute('title') }}</h1>

    <form method="POST" action="{{ route('blog.works.store', $blog) }}">
        @csrf

        <div class="mb-3">
            <label for="duallist" class="form-label">Оберіть роботи СТО</label>
            <select id="duallist" name="repair_works[]" multiple>
                @foreach ($repairWorks as $id => $title)
                    <option value="{{ $id }}" @selected(in_array($id, old('repair_works', $selectedWorks ?? [])))>
                        {{ $title }}
                    </option>
                @endforeach
            </select>
            @error('repair_works')
            <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Зберегти роботи</button>
        <a href="{{ route('blog.show', $blog) }}" class="btn btn-secondary">Назад до запису</a>
    </form>
@endsection
