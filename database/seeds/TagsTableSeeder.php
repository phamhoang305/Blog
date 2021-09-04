<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'postID'=>1,
                'tag'=>'MYSQL',
                'tag_slug'=>'mysql'
            ],
            [
                'postID'=>2,
                'tag'=>'NODEJS',
                'tag_slug'=>'nodejs'
            ],
            [
                'postID'=>3,
                'tag'=>'JAVASCRIPT',
                'tag_slug'=>'javascript'
            ],
            [
                'postID'=>3,
                'tag'=>'NODEJS',
                'tag_slug'=>'nodejs'
            ],
            [
                'postID'=>4,
                'tag'=>'REACTJS',
                'tag_slug'=>'reactjs'
            ],
            [
                'postID'=>5,
                'tag'=>'REACTJS',
                'tag_slug'=>'reactjs'
            ]
        ]);
    }
}
