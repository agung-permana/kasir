<?php

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'name' => 'Cafe Ruang Rindu',
            'address' => 'Cikande',
            'city' => 'Serang',
            'phone' => '085319196216'
        ]);
    }
}
