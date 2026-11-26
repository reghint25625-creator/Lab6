<?php

namespace App\Http\Controllers;

use App\Models\Tracker;
use App\Models\Appointment;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    // Зведена статистика за сторінками або IP
    public function pages(Request $request)
    {
        $type = $request->query('type', 'page');
        if (!in_array($type, ['page', 'ip'], true)) {
            abort(400, 'Невідомий тип групування.');
        }

        $rows = Tracker::query()
            ->selectRaw("{$type}, count(*) as hits, max(visited_at) as last_visit")
            ->groupBy($type)
            ->orderByDesc('hits')
            ->get();

        return view('stats.pages', compact('rows', 'type'));
    }

    // Детальна статистика звернень із посторінковим виведенням
    public function detail(Request $request)
    {
        $type = $request->query('type', 'page');
        $item = $request->query('item');

        if (!in_array($type, ['page', 'ip'], true)) {
            abort(400, 'Невідомий тип фільтрації.');
        }

        $rows = Tracker::query()
            ->when($item, fn ($query, $value) => $query->where($type, $value))
            ->orderByDesc('visited_at')
            ->paginate(15)
            ->withQueryString();

        return view('stats.detail', compact('rows', 'type', 'item'));
    }

    // ІНДИВІДУАЛЬНИЙ ПОКАЗНИК: Статистика популярності послуг автосервісу
    public function serviceStats()
    {
        $stats = Appointment::query()
            ->selectRaw('service_type, count(*) as total_bookings, count(DISTINCT car_model) as unique_cars')
            ->groupBy('service_type')
            ->orderByDesc('total_bookings')
            ->get();

        return view('stats.servstats', compact('stats'));
    }
}
