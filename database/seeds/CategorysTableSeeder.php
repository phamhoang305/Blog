<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array=array(
            ['cate_order'=>1,'icon'=>null,'name'=>'JAVASCRIPT'],
            ['cate_order'=>2,'icon'=>null,'name'=>'JQUERY'],
            ['cate_order'=>3,'icon'=>null,'name'=>'REACT JS'],
            ['cate_order'=>4,'icon'=>null,'name'=>'VUE JS'],
            ['cate_order'=>5,'icon'=>null,'name'=>'NODE JS'],
            ['cate_order'=>6,'icon'=>null,'name'=>'PHP'],
            ['cate_order'=>7,'icon'=>null,'name'=>'JAVA'],
            ['cate_order'=>8,'icon'=>null,'name'=>'ASP-NET'],
            ['cate_order'=>10,'icon'=>null,'name'=>'LARAVEL'],
        );

        DB::table('categorys')->insert([
            'cate_icon'=>null,
            'cate_name'=>"LẬP TRÌNH",
            'cate_slug'=>"lap-trinh",
            'cate_order'=>"1",
            "created_at"=>date('Y-m-d h:s:i')
        ]);
        DB::table('categorys')->insert([
            'cate_icon'=>null,
            'cate_name'=>"MÃ NGUỒN",
            'cate_slug'=>"ma-nguon",
            'cate_order'=>"2",
            "created_at"=>date('Y-m-d h:s:i')
        ]);
        foreach($array as $value){
             DB::table('categorys')->insert([
                'cate_parentID'=>1,
                'cate_icon'=>$value['icon'],
                'cate_name'=>$value['name'],
                'cate_slug_parent'=>'lap-trinh',
                'cate_slug'=>to_slug($value['name']),
                'cate_order'=>$value['cate_order'],
                "created_at"=>date('Y-m-d h:s:i')
            ]);
        }
        DB::table('categorys')->insert([
            'cate_icon'=>null,
            'cate_name'=>"THỦ THUẬT",
            'cate_slug'=>"thu-thuat",
            'cate_order'=>"4",
            "created_at"=>date('Y-m-d h:s:i')
        ]);
        DB::table('categorys')->insert([
            'cate_icon'=>null,
            'cate_name'=>"TIN TỨC",
            'cate_slug'=>"tin-tuc",
            'cate_order'=>"5",
            "created_at"=>date('Y-m-d h:s:i')
        ]);


    }
}
