@extends('layouts.app')

@section('title', 'Аналітика послуг СТО')

@section('content')
    <div style="padding: 20px;">
        <h2>Аналітика популярності послуг автосервісу</h2>

        <p style="margin-bottom: 20px;">
            <a href="{{ route('stats.pages') }}">Зведена статистика відвідувань</a> |
            <a href="{{ route('stats.services') }}">Популярність послуг</a>
        </p>

        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 900px; background: #fff;">
            <thead>
            <tr style="background-color: #f2f2f2; text-align: left;">
                <th>Вид послуги (Service Type)</th>
                <th>Кількість бронювань</th>
                <th>Кількість унікальних моделей авто</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($stats as $row)
                <tr>
                    <td>{{ $row->service_type }}</td>
                    <td>{{ $row->total_bookings }}</td>
                    <td>{{ $row->unique_cars }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">Даних про записи ще немає.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
