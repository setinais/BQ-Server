<?php

use Illuminate\Database\Seeder;

class AreaConhecimentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AreaConhecimento::class, 20)->create(['sub_categoria_id' => NULL]);
        factory(App\AreaConhecimento::class, 400)->create();
    }
}
