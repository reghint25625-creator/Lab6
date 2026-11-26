<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categoryNames = [
            'Новини сервісу',
            'Діагностика та ремонт',
            'ТО та розхідники',
            'Автоновини',
        ];

        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[] = Category::firstOrCreate([
                'category_name' => $name,
            ]);
        }

        $posts = [
            [
                'uk' => [
                    'title' => 'Сезонна заміна шин та перевірка ходової зі знижкою 15%',
                    'description' => 'Готуємо авто до зміни сезону: балансування, огляд підвіски та спецпропозиція для постійних клієнтів.',
                    'text' => "На нашому СТО стартував сезонний сервіс підготовки автомобілів до зміни погодних умов.\n\nПід час візиту майстри перевіряють стан протектора, виконують шиномонтаж із балансуванням коліс, оглядають сайлентблоки, амортизатори та гальмівну систему. За записом через онлайн-форму діє знижка 15% на роботи.",
                ],
                'en' => [
                    'title' => 'Seasonal Tire Change and Suspension Check with 15% Off',
                    'description' => 'Getting your car ready for the season: wheel balancing, suspension inspection, and a special offer for regular clients.',
                    'text' => "Our service center has launched seasonal vehicle preparation for changing weather conditions.\n\nDuring the visit, technicians inspect tread wear, perform tire fitting with wheel balancing, and check bushings, shock absorbers, and the braking system. Bookings made via the online form get 15% off labor.",
                ],
            ],
            [
                'uk' => [
                    'title' => 'Комп’ютерна діагностика двигуна: як розпізнати несправність на ранній стадії',
                    'description' => 'Розбираємо типові помилки ЕБУ, нестабільний холостий хід і збільшену витрату пального.',
                    'text' => "Сучасні автомобілі оснащені десятками датчиків, які контролюють сумішоутворення, запалювання, тиск наддуву та роботу вихлопної системи.\n\nСвоєчасне зчитування кодів помилок і аналіз параметрів у реальному часі допомагають усунути дрібну несправність до того, як вона призведе до дорогого ремонту вузлів двигуна.",
                ],
                'en' => [
                    'title' => 'Engine Computer Diagnostics: Spotting Faults Early',
                    'description' => 'Looking at common ECU error codes, rough idling, and rising fuel consumption.',
                    'text' => "Modern vehicles rely on dozens of sensors monitoring air-fuel mixture, ignition, boost pressure, and exhaust systems.\n\nTimely fault code scanning and live parameter analysis help fix minor issues before they turn into expensive engine repairs.",
                ],
            ],
            [
                'uk' => [
                    'title' => 'Як часто варто міняти моторне масло та фільтри при міській експлуатації',
                    'description' => 'Чому часті короткі поїздки та затори скорочують ресурс мастила швидше за заводський регламент.',
                    'text' => "Рух у щільному міському трафіку з частими зупинками та роботою двигуна на холостому ходу належить до важких умов експлуатації.\n\nНавіть якщо пробіг не досяг максимального значення за сервісною книжкою, рекомендуємо скорочувати інтервал заміни мастила та фільтрів, щоб підтримувати чистоту масляних каналів і ресурс турбіни.",
                ],
                'en' => [
                    'title' => 'How Often to Change Engine Oil and Filters in City Driving',
                    'description' => 'Why frequent short trips and traffic jams wear out oil faster than standard intervals.',
                    'text' => "Driving in heavy city traffic with frequent stops and extended idling counts as severe operating conditions.\n\nEven if mileage is below the maximum service manual limit, shortening oil and filter intervals helps keep oil passages clean and protects turbocharger longevity.",
                ],
            ],
            [
                'uk' => [
                    'title' => 'Оновлення обладнання: встановили новий стенд розвал-сходження',
                    'description' => 'Підвищуємо точність регулювання кутів установки коліс для легкових авто та кросоверів.',
                    'text' => "У нашому автосервісі введено в експлуатацію сучасний оптичний стенд розвал-сходження.\n\nПравильна геометрія підвіски забезпечує стабільну керованість на трасі, зменшує знос гуми та запобігає відведенню автомобіля вбік після ремонту ходової частини.",
                ],
                'en' => [
                    'title' => 'Equipment Upgrade: New Wheel Alignment Stand Installed',
                    'description' => 'Improving wheel angle adjustment accuracy for sedans, hatchbacks, and crossovers.',
                    'text' => "Our auto shop has put a modern wheel alignment system into operation.\n\nProper suspension geometry ensures stable handling on the road, reduces uneven tire wear, and prevents pulling after chassis repairs.",
                ],
            ],
            [
                'uk' => [
                    'title' => 'Огляд гальмівної системи: ознаки зносу колодок і дисків',
                    'description' => 'Скрип, вібрація при гальмуванні та збільшений гальмівний шлях — коли час на СТО.',
                    'text' => "Гальмівна система безпосередньо впливає на безпеку руху в будь-яку погоду.\n\nПід час планового ТО ми вимірюємо залишкову товщину фрикційних накладок і гальмівних дисків, перевіряємо стан напрямних супортів і рівень гальмівної рідини.",
                ],
                'en' => [
                    'title' => 'Brake System Check: Signs of Pad and Rotor Wear',
                    'description' => 'Squealing, brake pedal vibration, and longer stopping distances — when to visit the shop.',
                    'text' => "The braking system directly affects driving safety in all weather conditions.\n\nDuring scheduled maintenance, we measure remaining pad and rotor thickness and inspect caliper slide pins and brake fluid condition.",
                ],
            ],
            [
                'uk' => [
                    'title' => 'Автоновини: виробники роблять ставку на гібридні силові установки',
                    'description' => 'Чому паралельні та послідовні гібриди залишаються популярними на тлі розвитку електромобілів.',
                    'text' => "Багато автовиробників коригують плани переходу на повністю електричні лінійки та розширюють пропозицію гібридних моделей.\n\nПоєднання ДВЗ і електромотора дозволяє знизити витрату пального в місті без залежності від зарядної інфраструктури у далеких поїздках.",
                ],
                'en' => [
                    'title' => 'Auto News: Automakers Double Down on Hybrid Powertrains',
                    'description' => 'Why hybrid vehicles remain in high demand alongside electric cars.',
                    'text' => "Many automakers are adjusting all-electric transition timelines and expanding their hybrid lineups.\n\nCombining an internal combustion engine with an electric motor lowers city fuel consumption without relying on charging infrastructure for long trips.",
                ],
            ],
            [
                'uk' => [
                    'title' => 'Обслуговування кондиціонера та клімат-контролю перед літом',
                    'description' => 'Перевірка герметичності контуру, заправка холодоагентом та антибактеріальна обробка.',
                    'text' => "З часом кількість холодоагенту в системі кондиціонування поступово зменшується, а на випарнику накопичується волога.\n\nПрофілактична перевірка тиску, дозаправка та чистка вентиляційних каналів відновлюють ефективне охолодження салону і прибирають неприємні запахи.",
                ],
                'en' => [
                    'title' => 'AC and Climate Control Service Before Summer',
                    'description' => 'Leak testing, refrigerant recharge, and cabin system sanitization.',
                    'text' => "Over time, refrigerant levels slowly drop while moisture builds up on the evaporator.\n\nPreventive pressure testing, recharging, and airflow sanitization restore fast cabin cooling and eliminate unwanted odors.",
                ],
            ],
            [
                'uk' => [
                    'title' => 'Підготовка автомобіля до дальньої поїздки: чек-лист майстра',
                    'description' => 'Що перевірити перед виїздом на трасу: технічні рідини, світло, тиск у шинах і АКБ.',
                    'text' => "Перед далекою поїздкою варто приділити увагу ключовим вузлам, щоб уникнути простоїв у дорозі.\n\nНаш чек-лист включає контроль рівня мастила, антифризу та омивача, перевірку ближнього і дальнього світла, тиску в колесах та стану акумулятора.",
                ],
                'en' => [
                    'title' => 'Preparing Your Car for a Road Trip: Mechanic Checklist',
                    'description' => 'What to check before hitting the highway: fluids, lighting, tire pressure, and battery.',
                    'text' => "Before a long trip, checking key systems helps prevent unexpected breakdowns on the road.\n\nOur checklist covers engine oil, coolant, and washer fluid levels, headlight aim, tire pressure, and battery health.",
                ],
            ],
        ];

        foreach ($posts as $index => $postData) {
            $uk = $postData['uk'];
            $category = $categories[$index % count($categories)];

            $blog = Blog::updateOrCreate(
                ['title' => $uk['title']],
                [
                    'description' => $uk['description'],
                    'text' => $uk['text'],
                    'category_id' => $category->category_id,
                    'user_id' => null,
                ]
            );

            foreach ($postData as $locale => $fields) {
                BlogTranslation::updateOrCreate(
                    [
                        'blog_id' => $blog->blog_id,
                        'locale' => $locale,
                    ],
                    [
                        'title' => $fields['title'],
                        'description' => $fields['description'],
                        'text' => $fields['text'],
                    ]
                );
            }
        }
    }
}
