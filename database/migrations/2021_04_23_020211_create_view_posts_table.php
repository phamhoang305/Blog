<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS view_posts');
        DB::unprepared("CREATE VIEW view_posts AS
            SELECT * FROM (
                SELECT
                posts.*,
                users.id AS userID ,
                users.full_name,
                users.username,
                users.phone,
                users.sex,
                users.avatar,
                users.email ,
                comments.CountComments,
                follows.CountFollows,
                following.CountFollowing,
                categorys.id AS categorysID,
                categorys.cate_icon,
                categorys.cate_name,
                categorys.cate_slug,
                categorys.cate_slug_parent
                FROM posts AS posts LEFT JOIN
            (
                SELECT * FROM (
                    SELECT comments.commentable_id AS commentable_id ,COUNT(comments.id) AS CountComments
                        FROM comments
                        GROUP BY comments.commentable_id
                    ) comments
            ) AS comments
            ON posts.id = comments.commentable_id
            LEFT JOIN (
                    SELECT *
                    FROM users
            )AS users
            ON users.id = posts.user_id
            LEFT JOIN (
                    SELECT * FROM
                    (
                        SELECT follows.user_id AS user_id,COUNT(follows.id) AS CountFollows
                        FROM follows
                        GROUP BY follows.user_id
                    ) AS follows
            )AS follows
            ON users.id = follows.user_id
            LEFT JOIN (
                    SELECT * FROM
                    (
                        SELECT follows.follow_user_id AS follow_user_id,COUNT(follows.id) AS CountFollowing
                        FROM follows
                        GROUP BY follows.follow_user_id
                    ) AS following
            )AS following
            ON users.id = following.follow_user_id
            LEFT JOIN (
                    SELECT *
                    FROM categorys
            )AS categorys
            ON categorys.id = posts.category_id
            )AS posts
        ");
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_posts');
    }
}
