<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'role_name'=>'Quản lý ',
                'role_des'=>' Người quản lý hệ thống',
                'permission'=>'["category.view","category.add","category.delete","category.edit","page.view","page.add","page.delete","page.edit","post.public","post.draft","post.lock","post.approve","post.trash","post.add","post.delete","post.edit","post.approvePublic","comment.view","comment.delete","ad.view","ad.edit","sitemap.view","sitemap.edit","user.view","user.add","user.delete","user.edit","role.view","role.add","role.delete","role.edit","setting.view","setting.edit"]',
                'created_at'=>date('Y-m-d h:s:i')
            ],
            [
                'role_name'=>'Tác giả',
                'role_des'=>' Người viết bài',
                'permission'=>'[]',
                'created_at'=>date('Y-m-d h:s:i'),
            ]
        ]);
    }
}
