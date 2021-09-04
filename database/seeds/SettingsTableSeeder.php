<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                'logo'=>'',
                'icon'=>'',
                'name'=>'ĐINH VĂN LÀNH',
                'title'=>'Đam mê code ',
                'des'=>'Đam mê code - Tin tức, chia sẻ kiến thức, khóa học lập trình, Tải source code free, Download source code free',
                'keywords'=>'Đam mê code, Chia sẽ ,  Tin tức , học tập , kinh nghiệm ',
                'MAIL_DRIVER'=>'smtp',
                "MAIL_HOST"=>'smtp.gmail.com',
                "MAIL_PORT"=>'587',
                "MAIL_FROM_ADDRESS"=>'freelancertestcode@gmail.com',
                "MAIL_FROM_NAME"=>"ĐINH VĂN LÀNH",
                "MAIL_ENCRYPTION"=>'tls',
                "MAIL_USERNAME"=>"freelancertestcode@gmail.com",
                "MAIL_PASSWORD"=>"dinhvanlanh12021996",
                "MAIL_RECEIVE"=>"dinhvanlanh.it@gmail.com",
                "contact_mail"=>'dinhvanlanh.it@gmail.com',
                "contact_phone"=>"0966334404",
                "contact_address"=>"95 Trạng trình  - Thành Phố Đà Lạt",
                "about"=>"Đam mê code",
                "license"=>'',
                "iframe_map"=>'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.2862576550974!2d108.44018161462591!3d11.954671891528665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317112da2b5c0cad%3A0xe438c0439913bfcf!2zMSDEkMaw4budbmcgUC4gxJAgVGhpw6puIFbGsMahbmcsIFBoxrDhu51uZyA4LCBUaMOgbmggcGjhu5EgxJDDoCBM4bqhdCwgTMOibSDEkOG7k25nLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1615694553880!5m2!1svi!2s" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                "twitter_url"=>"https://twitter.com/",
                "facebook_url"=>"https://facebook.com/",
                "youtube_url"=>"https://youtube.com/",
                "instagram_url"=>"https://www.instagram.com/",
                'licenseName'=>'fdev.tennis.com',
                'licenseKey'=>'EYNYLKSW1SFXX23JWUE4QXMSK7UM9',
                'AdSense'=>'',

                'facebook_client_id'=>'',
                'facebook_client_secret'=>'',
                'facebook_redirect'=>'',

                'google_client_id'=>'831855867209-2n99fj01vnc7oho2g278el22oul61q36.apps.googleusercontent.com',
                'google_client_secret'=>'4Cg-K7h7sw8RCRIAR3CjR-MF',
                'google_redirect'=>'https://dinhvanlanh.com/social/oauth/google/callback',

                'github_client_id'=>'a2bbb531145dad7d710e',
                'github_client_secret'=>'157c76e47b0a30dea6bc3958543d4dc57e1cf1f0',
                'github_redirect'=>'',

            ]
        );
    }
}
