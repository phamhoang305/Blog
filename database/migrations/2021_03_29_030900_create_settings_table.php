<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('seoImage')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->text('des')->nullable();
            $table->text('keywords')->nullable();
            $table->text('about')->nullable();
            $table->string('darkMode',3)->nullable()->default('on');
            $table->string('MAIL_DRIVER')->nullable();
            $table->string('MAIL_HOST')->nullable();
            $table->string('MAIL_PORT')->nullable();
            $table->string('MAIL_FROM_ADDRESS')->nullable();
            $table->string('MAIL_FROM_NAME')->nullable();
            $table->string('MAIL_ENCRYPTION')->nullable();
            $table->string('MAIL_USERNAME')->nullable();
            $table->string('MAIL_PASSWORD')->nullable();
            $table->string('MAIL_RECEIVE')->nullable();
            //contact
            $table->string('contact_mail')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_address')->nullable();
            // footer
            $table->text('license')->nullable();
            $table->text('iframe_map')->nullable();
            // mạng xã hội
            $table->text('facebook_url')->nullable();
            $table->text('twitter_url')->nullable();
            $table->text('youtube_url')->nullable();
            $table->text('instagram_url')->nullable();

            $table->text('licenseKey')->nullable();
            $table->text('licenseName')->nullable();

            $table->string('facebook_status')->nullable()->default('off');
            $table->string('facebook_client_id')->nullable();
            $table->string('facebook_client_secret')->nullable();
            $table->string('facebook_redirect')->nullable();
            $table->string('google_status')->nullable()->default('on');
            $table->string('google_client_id')->nullable();
            $table->string('google_client_secret')->nullable();
            $table->string('google_redirect')->nullable();
            $table->string('github_status')->nullable()->default('off');
            $table->string('github_client_id')->nullable();
            $table->string('github_client_secret')->nullable();
            $table->string('github_redirect')->nullable();

            $table->string('sidebar_post_random_status')->nullable()->default('on');
            $table->string('sidebar_top_author_status')->nullable()->default('on');
            $table->string('sidebar_tag_status')->nullable()->default('on');
            $table->string('user_add_post_status')->nullable()->default('on');
            $table->string('user_login_register_status')->nullable()->default('on');
            $table->string('sidebar_top_postview_status')->nullable()->default('on');

            $table->string('post_page_number')->nullable()->default(12);
            $table->string('sitemap_frequency')->nullable()->default('weekly');
            $table->text('Google_Analytics')->nullable();
            $table->text('AdSense')->nullable();
            $table->string('route_admin')->nullable()->default('cpanel');
            $table->string('route_login')->nullable()->default('wp-admin');
            $table->integer('cache_seconds')->nullable()->default(180);

            $table->longtext('css_custom')->nullable();
            $table->longtext('javascript_custom')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
