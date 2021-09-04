<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->where('id','!=',1)->get();
        foreach($users as $item){
            if($item->id<=10){
                $follow_remove_id = DB::table('follow_remove')->insertGetId([
                    "user_id"=>$item->id,
                ]);
                DB::table('follows')->insert([
                    'user_id'=>1,
                    'follow_user_id'=>$item->id,
                    'follow_remove_id'=>$follow_remove_id
                ]);
            }

        }
        foreach($users as $item){
            if($item->id<=8){
                $follow_remove_id = DB::table('follow_remove')->insertGetId([
                    "user_id"=>$item->id,
                ]);
                DB::table('follows')->insert([
                    'user_id'=>$item->id,
                    'follow_user_id'=>1,
                    'follow_remove_id'=>$follow_remove_id
                ]);
            }

        }
    }
}
