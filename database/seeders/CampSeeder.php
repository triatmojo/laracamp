<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Camp;

class CampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $camps = [
            [
                'title' => 'Fullstack Developer',
                'slug' => 'fullstack-developer',
                'price' => 380,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],

            [
                'title' => 'DevOps Engineer',
                'slug' => 'devops-engineer',
                'price' => 400,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
        ];

        // 1st method
        // foreach ($camps as $key => $camp) {
        //     Camp::create($camp);
        // }

        // 2nd method
        Camp::insert($camps);
    }
}
