<?php

use Illuminate\Database\Seeder;

class TestCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('test_categorys')->insert([
            [
                'name'=>'PHP',
                'uniqid'=>uniqid(),
                'slug'=>'php'
            ],
            [
                'name'=>'Javascript',
                'uniqid'=>uniqid(),
                'slug'=>'javascript'
            ],
            [
                'name'=>'C++',
                'uniqid'=>uniqid(),
                'slug'=>'c-cong-cong'
            ],
            [
                'name'=>'C#',
                'uniqid'=>uniqid(),
                'slug'=>'c-shap'
            ],
        ]);
        DB::table('test_lists')->insert([
            [

                "test_categoryID"=>1,
                'uniqid'=>uniqid(),
                'testlist_name'=>'Test php phần 1'
            ],
            // [

            //     "test_categoryID"=>1,
            //     'uniqid'=>uniqid(),
            //     'testlist_name'=>'Test php phần 2'
            // ],
        ]);
        for($i=0;$i<=100;$i++){
            DB::table('test_details')->insert([
                [

                    'uniqid'=>uniqid(),
                    "test_listID"=>1,
                    'title'=>'Trình dịch PHP nào là trình dịch bạn cho là đúng ?'.$i,
                    "item"=>json_encode(array(
                        [
                            "uniqid"=>$i,
                            "name"=>"PHP Translator",
                        ],
                        [
                            "uniqid"=>uniqid(),
                            "name"=>"PHP Interpreter",
                        ],
                        [
                            "uniqid"=>uniqid(),
                            "name"=>"PHP Communicator",
                        ],
                        [
                            "uniqid"=>uniqid(),
                            "name"=>"Không có câu nào đúng",
                        ],
                    )),
                    "check_uniqid"=>$i
                ]
            ]);
        }
        DB::table('test_details')->insert([
            [

                'uniqid'=>uniqid(),
                "test_listID"=>1,
                'title'=>'Trình dịch PHP nào là trình dịch bạn cho là đúng ?',
                "item"=>json_encode(array(
                    [
                        "uniqid"=>"1111",
                        "name"=>"PHP Translator",
                    ],
                    [
                        "uniqid"=>uniqid(),
                        "name"=>"PHP Interpreter",
                    ],
                    [
                        "uniqid"=>uniqid(),
                        "name"=>"PHP Communicator",
                    ],
                    [
                        "uniqid"=>uniqid(),
                        "name"=>"Không có câu nào đúng",
                    ],
                )),
                "check_uniqid"=>"1111"
            ],
            [

                'uniqid'=>uniqid(),
                "test_listID"=>1,
                'testlist_name'=>'Engine nào là nền tảng chính của PHP?',
                "item"=>json_encode(array(
                    [
                        "uniqid"=>"2222",
                        "name"=>"ZEDAT",
                    ],
                    [
                        "uniqid"=>uniqid(),
                        "name"=>"ZEND",
                    ],
                    [
                        "uniqid"=>uniqid(),
                        "name"=>"ZENAT",
                    ],
                    [
                        "uniqid"=>uniqid(),
                        "name"=>"ZETA",
                    ],
                )),
                "check_uniqid"=>"2222"
            ],
        ]);
    }
}
