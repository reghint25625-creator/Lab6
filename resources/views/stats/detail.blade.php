@extends('layouts.app')

@section('title', 'Детальна статистика')

@section('content')
    <div style="margin: 20px auto; max-width: 1000px;">
        <h2>Детальна статистика</h2>

        <p style="margin: 15px 0;">
            Фільтр: <strong>{{ $type }}</strong> = <strong>{{ $item }}</strong> |
            <a href="{{ route('stats.pages') }}">Повернутися до зведеної статистики</a>
        </p>

        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; background: #fff;">
            <thead>
            <tr style="background-color: #f2f2f2; text-align: left;">
                <th>Сторінка</th>
                <th>IP</th>
                <th>User-Agent</th>
                <th>Статус</th>
                <th>Дата і час</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td>{{ $row->page }}</td>
                    <td>{{ $row->ip }}</td>
                    <td>{{ $row->user_agent }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->visited_at->format('d.m.Y H:i:s') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div style="margin-top: 15px;">
            {{ $rows->links() }}
        </div>
    </div>
@endsection
