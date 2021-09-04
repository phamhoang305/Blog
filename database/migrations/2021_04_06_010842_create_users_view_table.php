<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS users_view');
        DB::unprepared("CREATE VIEW users_view AS SELECT
        users.id,
        users.roleID,
        users.type,
        users.provider,
        users.email,
        users.avatar,
        users.username,
        users.full_name,
        users.phone,
        users.sex,
        users.birthday,
        users.address,
        users.about,
        users.darkMode,
        users.status,
        users.CountPosts,
        users.CountFollows,
        users.CountFollowing,
        users.created_at,
        users.updated_at,
        users.email_verified_token,
        users.status_notice_userFollow
        FROM (
            SELECT * FROM users AS TB_USERS LEFT JOIN
            (
                SELECT * FROM (
                    SELECT posts.user_id ,COUNT(posts.id) AS CountPosts
                    FROM posts
                    GROUP BY posts.user_id
                ) AS TB_POSTS
            ) AS TB_POST_NEW
            ON TB_USERS.id = TB_POST_NEW.user_id
            LEFT JOIN (
                SELECT * FROM
                (
                    SELECT follows.user_id AS user_id_follow,COUNT(follows.id) AS CountFollows
                    FROM follows
                    GROUP BY follows.user_id
                ) AS TB_FOLLOWS
            ) AS TB_FOLLOWS_NEW
            ON TB_FOLLOWS_NEW.user_id_follow = TB_USERS.id
            LEFT JOIN (
                SELECT * FROM (
                    SELECT follows.follow_user_id AS user_id_following,COUNT(follows.id) AS CountFollowing
                    FROM follows
                    GROUP BY follows.follow_user_id
                )AS TB_FOLLOWING
            )AS TB_FOLLOWING_NEW
            ON TB_FOLLOWING_NEW.user_id_following = TB_USERS.id
        ) AS users");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_view');
    }
}
