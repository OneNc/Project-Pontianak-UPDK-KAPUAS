<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'      => 'PLTD Sei Raya',
                'latitude'  => -0.07242899454302792,
                'longitude' => 109.38024792513356,
            ],
            [
                'name'      => 'PLTD Siantan',
                'latitude'  => 0.0028716675978206975,
                'longitude' => 109.32728225564387,
            ],
            [
                'name'      => 'PLTD Sukaharja',
                'latitude'  => -1.7964341422900385,
                'longitude' => 109.9740048673113,
            ],
            [
                'name'      => 'PLTD Sei Wie',
                'latitude'  => 1.2769730509354378,
                'longitude' => 109.00654782875361,
            ],
            [
                'name'      => 'PLTD Menyurai',
                'latitude'  => 0.08929268633445846,
                'longitude' => 111.50948303236102,
            ],
        ];

        foreach ($data as $row) {
            // supaya kalau dijalankan berkali-kali tidak dobel
            Group::updateOrCreate(
                ['name' => $row['name']],
                $row
            );
        }
    }
}
