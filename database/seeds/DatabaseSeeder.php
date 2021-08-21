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
        if(\Storage::exists(("uploads"))){
            \Storage::deleteDirectory(("uploads"));
        }
        \Storage::makeDirectory(("uploads"));
        \Storage::makeDirectory(("uploads/thumbnails"));
        \Storage::makeDirectory(("uploads/contents"));
        \Storage::makeDirectory(("uploads/thumbnails/min"));
        \Storage::makeDirectory(("uploads/thumbnails/max"));
        \Storage::makeDirectory(("uploads/settings"));
        \Storage::makeDirectory(("uploads/ads"));
        $this->call(
            [
                AdSpacesTableSeeder::class,
                RolesTableSeeder::class,
                SettingsTableSeeder::class,
                UsersTableSeeder::class,
                CategorysTableSeeder::class,
                // PostsTableSeeder::class,
                // TagsTableSeeder::class,
                // FollowsTableSeeder::class,
                // TestCategoryTableSeeder::class
            ]

        );
    }
}
