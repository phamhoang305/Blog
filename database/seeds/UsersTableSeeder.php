<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        $faker->addProvider(new Ottaviano\Faker\Gravatar($faker));
         DB::table('users')->insert(
            [
                [
                    "type"=>'userAdminDefault',
                    'username'=>'24hcode',
                    'roleID'=>NULL,
                    'email' => 'dinhvanlanh.it@gmail.com',
                    'phone'=> '0966334404',
                    'password' => bcrypt('123456'),
                    'avatar'=>null,//$faker->gravatarUrl(),
                    'full_name'=>'Admin',
                    'sex'=>'male',
                    'about'=>"CODE VÌ ĐAM MÊ",
                    'birthday'=>'1996-12-02',
                    'address'=>'Thôn KaTu - Xã Sơn Hạ - Huyện Sơn Hà - Tỉnh Quảng Ngãi',
                    'status'=>0,
                    'status_approve'=>'off',
                    'darkMode'=>'off',
                    'created_at'=>date('Y-m-d h:s:i')
                ],
                [
                    "type"=>'userAdminCreate',
                    'username'=>'dinhthinamsha',
                    'roleID'=>1,
                    'email' => 'dinhthinamsha@gmail.com',
                    'phone'=> '0966334409',
                    'password' => bcrypt('123456'),
                    'avatar'=>null,//$faker->gravatarUrl(),
                    'full_name'=>'Đinh Thị Nam',
                    'sex'=>'male',
                    'about'=>"CODE VÌ ĐAM MÊ",
                    'birthday'=>'1994-02-02',
                    'address'=>'Thôn KaTu - Xã Sơn Hạ - Huyện Sơn Hà - Tỉnh Quảng Ngãi',
                    'status'=>0,
                    'status_approve'=>'on',
                    'darkMode'=>'off',
                    'created_at'=>date('Y-m-d h:s:i')
                ],
            ]
        );
        $data = array();
        for($i=1;$i<=8;$i++){
            $row["type"]='userCreate';
            $row['username']= 'username'.$i;
            $row['email']= $faker->name;
            $row['phone']= "09663344".$i;
            $row['password'] = bcrypt('123456');
            $row['avatar']=null;//$faker->gravatarUrl();
            $row['full_name']=$faker->name;
            $row['sex']='male';
            $row['about']=$faker->name;
            $row['birthday']=date('Y-m-d');
            $row['address']=$faker->address;
            $row['created_at']=date('Y-m-d h:s:i');
            $data =  DB::table('users')->insert( $row);
        }
        for($i=10;$i<=12;$i++){
            $row["type"]='userCreate';
            $row['username']= 'username'.$i;
            $row['email']= $faker->name.$i;
            $row['phone']= "09663344".$i;
            $row['password'] = bcrypt('123456');
            $row['avatar']=null;//$faker->gravatarUrl();
            $row['full_name']=$faker->name;
            $row['sex']='male';
            $row['about']=$faker->name;
            $row['birthday']=date('Y-m-d');
            $row['address']=$faker->address;
            $row['created_at']=date('Y-m-d h:s:i');
            $data =  DB::table('users')->insert( $row);
        }
    }
}
