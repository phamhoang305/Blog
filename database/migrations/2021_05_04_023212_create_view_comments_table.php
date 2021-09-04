<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS view_comments');
        DB::unprepared("CREATE VIEW view_comments AS
                SELECT comments.*,
                users.full_name,
                users.email,
                view_posts.post_title,
                view_posts.post_slug,
                view_posts.cate_slug,
                view_posts.cate_slug_parent
                FROM
                comments
                LEFT JOIN users
                ON users.id = comments.commenter_id
                JOIN view_posts
                ON view_posts.id = comments.commentable_id

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_comments');
    }
}
