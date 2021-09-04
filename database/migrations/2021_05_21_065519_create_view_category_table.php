<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS view_category');
        DB::unprepared("CREATE VIEW view_category AS
            SELECT * from categorys
            LEFT JOIN (
            SELECT * FROM(
                SELECT posts.category_id AS category_id,COUNT(posts.category_id) AS CountPosts
                    FROM posts
                    WHERE posts.post_status = 'published'
                    GROUP BY posts.category_id
                ) AS tb_posts
            ) AS tb_posts
            ON  categorys.id =  tb_posts.category_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_category');
    }
}
