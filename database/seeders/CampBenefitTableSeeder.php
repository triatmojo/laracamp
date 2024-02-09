<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CampBenefit;
class CampBenefitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campBenefits = [
            [
                'camp_id' => 1,
                'title' => 'Pro TechStack Kit'
            ],
            [
                'camp_id' => 1,
                'title' => 'Macbook Pro 2022 & Display'
            ],
            [
                'camp_id' => 1,
                'title' => '1-1 Mentoring Program'
            ],
            [
                'camp_id' => 1,
                'title' => 'Final Project Certificate'
            ],
            [
                'camp_id' => 1,
                'title' => 'Offline Course Video'
            ],
            [
                'camp_id' => 1,
                'title' => 'Future Job Opportunity'
            ],
            [
                'camp_id' => 1,
                'title' => 'Premium Design Kit'
            ],
            [
                'camp_id' => 1,
                'title' => 'Website Builders'
            ],
            [
                'camp_id' => 2,
                'title' => '1-1 Mentoring Program'
            ],
            [
                'camp_id' => 2,
                'title' => 'Final Project Certificate'
            ],
            [
                'camp_id' => 2,
                'title' => 'Offline Course Video'
            ]    
        ];
        
        CampBenefit::insert($campBenefits);
    }
}
