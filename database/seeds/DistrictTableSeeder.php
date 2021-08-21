<?php

use Illuminate\Database\Seeder;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function Insert_QuanHuyen_QuangNgai($id)
     {
        $QuangNgais = array(
            "Thành phố Quảng Ngãi",
            "Huyện Ba Tơ",
            "Huyện Bình Sơn",
            "Huyện Đức Phổ",
            "Huyện Lý Sơn",
            "Huyện Minh Long",
            "Huyện Mộ Đức",
            "Huyện Nghĩa Hành",
            "Huyện Sơn Hà",
            "Huyện Sơn Tây",
            "Huyện Sơn Tịnh",
            "Huyện Tây Trà",
            "Huyện Trà Bồng",
            "Huyện Tư Nghĩa",
        );
        $QuangNgais_insert = array();
        foreach ($QuangNgais as $value) {
            $row['provinceID']= $id;
            $row['district_name']= $value;
            $row['district_slug']= to_slug($value);
            $row['created_at']= date('Y-m-d h:s:i');
            $QuangNgais_insert[]=$row;
        }
        DB::table('district')->insert($QuangNgais_insert);
     }

    public function run()
    {
        $this->Insert_QuanHuyen_QuangNgai(48);
    }
}
