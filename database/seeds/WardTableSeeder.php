<?php

use Illuminate\Database\Seeder;

class WardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function Insert_PhuongXaThiTrang_HuyenSonHa_QuangNgai($provinceID,$districtID)
    {
        $data = array(
            "Thị trấn Di Lăng",
            "Xã Sơn Ba",
            "Xã Sơn Bao",
            "Xã Sơn Cao",
            "Xã Sơn Giang",
            "Xã Sơn Hạ",
            "Xã Sơn Hải",
            "Xã Sơn Kỳ",
            "Xã Sơn Linh",
            "Xã Sơn Nham",
            "Xã Sơn Thành",
            "Xã Sơn Thượng",
            "Xã Sơn Thủy",
            "Xã Sơn Trung",
        );
        $insert = array();
        foreach ($data as $value) {
            $row['provinceID']= $provinceID;
            $row['districtID']= $districtID;
            $row['ward_name']= $value;
            $row['ward_slug']= to_slug($value);
            $row['created_at']= date('Y-m-d h:s:i');
            $insert[]=$row;
        }
        DB::table('ward')->insert($insert);
    }
    public function run()
    {
        $this->Insert_PhuongXaThiTrang_HuyenSonHa_QuangNgai(48,9);
    }
}
