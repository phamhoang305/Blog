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
        if(\File::exists(public_path("uploads"))){
            \File::deleteDirectory(public_path("uploads"));
        }
        \File::makeDirectory(public_path("uploads"));
        \File::makeDirectory(public_path("uploads/thumbnails"));
        \File::makeDirectory(public_path("uploads/contents"));
        \File::makeDirectory(public_path("uploads/settings"));
        \File::makeDirectory(public_path("uploads/ads"));
        $this->call(
            [
                AdSpacesTableSeeder::class,
                RolesTableSeeder::class,
                SettingsTableSeeder::class,
                UsersTableSeeder::class,
                CategorysTableSeeder::class,
                PostsTableSeeder::class,
                // TagsTableSeeder::class,
                // FollowsTableSeeder::class,
                TestCategoryTableSeeder::class
            ]

        );
    }
}
