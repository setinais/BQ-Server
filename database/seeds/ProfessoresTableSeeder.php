<?php

use Illuminate\Database\Seeder;

class ProfessoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Professor::class, 100)->create();
        for($i=1;$i<101;$i++){
        	factory(App\ControleAcesso::class,1)->create(['user_id' => $i]);
		}
    }
}
