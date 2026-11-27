@extends('layouts.app')

@section('title', 'Користувачі системи')

@section('content')
    <div style="background-color: #ffffff; padding: 24px; border-radius: 10px; border: 1px solid #ddd;">
        <h1 style="margin: 0 0 20px 0; font-size: 26px; color: #0a3622;">
            Користувачі системи
        </h1>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                <tr style="background-color: #0a3622; color: #ffffff; text-align: left;">
                    <th style="padding: 12px; border: 1px solid #0a3622; width: 50px;">#</th>
                    <th style="padding: 12px; border: 1px solid #0a3622;">Ім'я</th>
                    <th style="padding: 12px; border: 1px solid #0a3622;">Електронна пошта</th>
                    <th style="padding: 12px; border: 1px solid #0a3622; width: 170px;">Дата реєстрації</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $i => $user)
                    <tr style="background-color: {{ $loop->even ? '#f8f9fa' : '#ffffff' }};">
                        <td style="padding: 10px 12px; border: 1px solid #dee2e6;">
                            {{ $users->firstItem() + $i }}
                        </td>
                        <td style="padding: 10px 12px; border: 1px solid #dee2e6; font-weight: bold;">
                            {{ $user->name }}
                        </td>
                        <td style="padding: 10px 12px; border: 1px solid #dee2e6;">
                            {{ $user->email }}
                        </td>
                        <td style="padding: 10px 12px; border: 1px solid #dee2e6; color: #555;">
                            {{ $user->created_at?->format('d.m.Y H:i') ?? '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 16px; border: 1px solid #dee2e6; text-align: center; color: #666;">
                            Користувачів поки немає.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 16px;">
            {{ $users->links() }}
        </div>
    </div>
@endsection
