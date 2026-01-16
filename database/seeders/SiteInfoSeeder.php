<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cache::flush();


        Info::truncate();

        $siteInfo =
            [
                'hero' => [
                    'logo' => 'logo',
                    'image' => 'image',
                    'company_description' => 'gug',
                    'successful_projects' => '+200',
                    'experience_years' => '+5',
                    'clients' => '+20',
                    'development_hours' => '+300',
                ],
                'about' => [
                    'about_us' => 'about',
                    'image' => 'image',
                    'whatsapp' => 'IdeaCodeReality.ICR@gmail.com',
                    'youtube' => 'IdeaCodeReality.ICR@gmail.com',
                    'linkedIn' => 'IdeaCodeReality.ICR@gmail.com',
                    'twitter' => 'IdeaCodeReality.ICR@gmail.com',
                    'facebook' => 'IdeaCodeReality.ICR@gmail.com',
                    'instagram' => 'IdeaCodeReality.ICR@gmail.com',
                    'telegram' => 'IdeaCodeReality.ICR@gmail.com',
                    'email' => 'email@email.com',
                    'phone_number' => 'email@email.com',
                    'rights' => 'all rights are saved',
                ],
            ];

        $dataToSeed = [];
        foreach ($siteInfo as $superKey => $datum) {
            foreach ($datum as $key => $item) {
                $dataToSeed[] = [
                    'super_key' => $superKey,
                    'key' => $key,
                    'value' => is_array($item) ? json_encode($item, JSON_UNESCAPED_UNICODE) : $item,
                ];
            }
        }
        Info::insert($dataToSeed);


    }
}
