<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $users = [
            [
                'name' => 'Developer',
                'username' => 'Developer',
                'password' => '$2y$12$JtBDML5Fvb6txi9HqJewNO3DEaOQbrmMn7Qwnt4wnaMEPddxyoXz2',
            ],
            [
                'name' => 'Idrus',
                'username' => 'idrus',
                'password' => '$2y$12$9s4ocVa0U3UwUXG5jC4aY.WY41ff1rqLLysv7/hT37sClJTrGTrqy'
            ],
            [
                'name' => 'Arif',
                'username' => 'arif',
                'password' => '$2y$12$sdK2bX/acSItOH8kK3GkLeGINJ03xEXnaRCtnK5weG0KSQW8aHG0a'
            ],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => bcrypt("PLTDAdministrator")
            ],
            [
                'name' => "ROBBI TAMPUBOLON",
                'username' => "8409493Z",
                'password' => bcrypt("P@ssw0rdupks")
            ],
            [
                'name' => "MUHAMMAD SHOLEH",
                'username' => "93161936ZY",
                'password' => bcrypt("P@ssw0rdupks")
            ],
            [
                'name' => "FARHAN WIBOWO",
                'username' => "9112027CY",
                'password' => bcrypt("P@ssw0rdupks")
            ],
            [
                'name' => "ERWIN SUJATMIKO",
                'username' => "9216919ZY",
                'password' => bcrypt("P@ssw0rdsera")
            ],
            [
                'name' => "ELIEZER KRISTIAN AMBARITA",
                'username' => "9313077CY",
                'password' => bcrypt("P@ssw0rdsera")
            ],
            [
                'name' => "JUWANDI",
                'username' => "8709030C",
                'password' => bcrypt("P@ssw0rdsewie")
            ],
            [
                'name' => "MOHAMMAD REZA FAHLEVI",
                'username' => "0024126ZJY",
                'password' => bcrypt("P@ssw0rdsewie")
            ],
            [
                'name' => "FITRA RIA HERMAWAN",
                'username' => "8908017C",
                'password' => bcrypt("P@ssw0rdstn")
            ],
            [
                'name' => "ADI PUTRA",
                'username' => "9514116CY",
                'password' => bcrypt("P@ssw0rdstn")
            ],
            [
                'name' => "MUHAMMAD AKBAR FADHILA",
                'username' => "94171212ZY",
                'password' => bcrypt("P@ssw0rdstg")
            ],
            [
                'name' => "CHOLILUR RAHMAN",
                'username' => "9514120CY",
                'password' => bcrypt("P@ssw0rdstg")
            ],
            [
                'name' => "DWI MUHADIYANTORO",
                'username' => "94191367ZY",
                'password' => bcrypt("P@ssw0rdktp")
            ],
            [
                'name' => "FERIANSYAH GUNAWAN",
                'username' => "9616013LAY",
                'password' => bcrypt("P@ssw0rdktp")
            ],
            [
                'name' => "ITDKP",
                'username' => "itdkp",
                'password' => '$2y$12$RDOagD00drd50JDYMdrjGehypRjOnG38y.y0xmrekK6pieLiEYBN2'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
