<?php

use Illuminate\Database\Seeder;

class AdSpacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ad_spaces')->insert([
            [
                'type'=>'home_header',
                'name'=>'Home Header',
                'url'=>'',
                'image'=>'',
                'code'=>'',
            ],
            [
                'type'=>'home_footer',
                'name'=>'Home Footer',
                'url'=>'',
                'image'=>'',
                'code'=>'',
            ],
            [
                'type'=>'sidbar_header',
                'name'=>'Sidebar Header',
                'url'=>'',
                'image'=>'',
                'code'=>'',
            ],
            [
                'type'=>'sidbar_footer',
                'name'=>'Sidebar Footer',
                'url'=>'',
                'image'=>'',
                'code'=>'',
            ],
            [
                'type'=>'sidbar_center',
                'name'=>'Sidebar Center',
                'url'=>'',
                'image'=>'',
                'code'=>'',
            ],
            [
                'type'=>'post_header',
                'name'=>'Post Header',
                'url'=>'',
                'image'=>'',
                'code'=>'',
            ],
            [
                'type'=>'post_footer',
                'name'=>'Post Footer',
                'url'=>'',
                'image'=>'',
                'code'=>'',
            ],
        ]);
    }
}
