<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Tourist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingAndCommentAndRattingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tourist_id = 1;
        $bookings = [
            [
                "start_date" => "2026-03-01",
                "end_date" =>  "2026-03-10",
                "quantity" => 1,
                "price" => 1000,
                "tourist_id" => $tourist_id,
                "service_id" => 2
            ],
            [
                "start_date" => "2026-03-01",
                "end_date" =>  "2026-03-10",
                "quantity" => 1,
                "price" => 500,
                "tourist_id" => $tourist_id,
                "service_id" => 3
            ],
        ];
        Booking::insert($bookings);

        Tourist::find($tourist_id)->ratings()->attach(2, ['rate' => 4]);
        Tourist::find($tourist_id)->comments()->attach(2, ['comment' => 'حلوة ومفيدة', 'type' => 'positive']);
        Tourist::find($tourist_id)->comments()->attach(2, ['comment' => 'متعبة ومضغوطة', 'type' => 'negative']);
    }
}
