@extends('layouts.app')

@section('title', 'Статистика відвідувань')

@section('content')
    <div style="margin: 20px auto; max-width: 900px;">
        <h2>Статистика відвідувань</h2>

        <p style="margin: 15px 0;">
            <a href="{{ route('stats.pages', ['type' => 'page']) }}">За сторінками</a> |
            <a href="{{ route('stats.pages', ['type' => 'ip']) }}">За ІР-адресами</a> |
            <a href="{{ route('stats.services') }}">Аналітика послуг СТО</a>
        </p>

        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; background: #fff;">
            <thead>
            <tr style="background-color: #f2f2f2; text-align: left;">
                <th>{{ $type === 'page' ? 'Сторінка' : 'ІР-адреса' }}</th>
                <th>Звернень</th>
                <th>Останній візит</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($rows as $row)
                <tr>
                    <td>
                        <a href="{{ route('stats.detail', ['type' => $type, 'item' => $row->{$type}]) }}">
                            {{ $row->{$type} }}
                        </a>
                    </td>
                    <td>{{ $row->hits }}</td>
                    <td>{{ $row->last_visit }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">Даних ще немає.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
