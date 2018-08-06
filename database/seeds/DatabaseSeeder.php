<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->command->info('Unguarding models');
	    Model::unguard();
        $tables = [
         'roles',
          ];
		$this->command->info('Truncating existing tables');
        foreach ($tables as $table) {  
        DB::statement('TRUNCATE TABLE ' . $table . ' CASCADE');

        }

        //$this->call(RolSeeder::class);
        //$this->call(TypeIdentificationSeeder::class);
        //$this->call(ConfigMasterSeeder::class);
        //$this->call(TypeNotificationSeeder::class);
        //$this->call(TypeIdentificationSeeder::class);
    }
}
