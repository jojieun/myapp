<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call(ChannelsTableSeeder::class);
        $this->command->info('Channels table seeded');
        $this->call(RegionsTableSeeder::class);
        $this->command->info('Regions table seeded');
        $this->call(AreasTableSeeder::class);
        $this->command->info('Areas table seeded');
        $this->call(ExposuresTableSeeder::class);
        $this->command->info('exposures table seeded');
        $this->call(PromotionsTableSeeder::class);
        $this->command->info('promotions table seeded');
DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
