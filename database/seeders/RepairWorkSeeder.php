<?php

namespace Database\Seeders;

use App\Models\RepairWork;
use Illuminate\Database\Seeder;

class RepairWorkSeeder extends Seeder
{
    public function run(): void
    {
        $works = [
            ['title' => 'Заміна мастила та фільтрів', 'description' => 'Планове обслуговування двигуна', 'price' => 1200.00],
            ['title' => 'Діагностика ходової частини', 'description' => 'Перевірка підвіски, сайлентблоків та амортизаторів', 'price' => 700.00],
            ['title' => 'Комп’ютерна діагностика', 'description' => 'Зчитування та скидання помилок ЕБУ', 'price' => 800.00],
            ['title' => 'Розвал-сходження', 'description' => 'Регулювання кутів установки коліс', 'price' => 950.00],
            ['title' => 'Обслуговування гальмівної системи', 'description' => 'Заміна колодок, дисків та прокачування', 'price' => 1500.00],
            ['title' => 'Шиномонтаж і балансування', 'description' => 'Сезонна заміна та балансування шин', 'price' => 1100.00],
        ];

        foreach ($works as $work) {
            RepairWork::firstOrCreate(
                ['title' => $work['title']],
                [
                    'description' => $work['description'],
                    'price' => $work['price'],
                ]
            );
        }
    }
}
