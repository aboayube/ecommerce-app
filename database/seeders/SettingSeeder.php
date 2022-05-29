<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {






        Setting::create([
            'name' => 'دروازه ',
            'name_en' => 'دروازه ',
            'discription' => 'دروازه ',
            'discription_en' => 'دروازه ',
            'image' => 'logo.png',
            'email' => 'Darwazeh@gmail.com',
            'facebook' => 'Darwazeh@gmail.com',
            'twiter' => 'Darwazeh@gmail.com',
            'linked_in' => 'Darwazeh@gmail.com',
            'instagram' => 'Darwazeh@gmail.com',
            'whatsapp' => 'Darwazeh@gmail.com',
            'address' => 'Darwazeh',
            'address_en' => 'Darwazeh',
            'Terms' => 'Darwazeh',
            'Terms_en' => 'Darwazeh',
            'who_us' => 'Darwazeh',
            'who_us_en' => 'Darwazeh',
        ]);
    }
}
