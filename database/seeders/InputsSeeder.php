<?php

namespace Database\Seeders;

use App\Models\ProductdetialsInput;
use Illuminate\Database\Seeder;

class InputsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductdetialsInput::create([
            'input1' => 'مقاس',
            'input1_en' => 'مقاس',
            'input2' => 'شكل',
            'input2_en' => 'شكل',
            'user_id' => 1
        ]);
        //
    }
}
