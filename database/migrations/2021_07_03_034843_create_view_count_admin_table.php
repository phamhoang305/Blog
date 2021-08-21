<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewCountAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS view_count_admin');
        DB::unprepared("CREATE VIEW view_count_admin AS
            SELECT * FROM (
                SELECT 'categorys_parent' AS `KEY` ,COUNT(*) AS `VALUE` FROM categorys WHERE categorys.cate_parentID IS NULL
            UNION
                SELECT 'categorys_sub' AS `KEY` ,COUNT(*) AS `VALUE` FROM categorys  WHERE categorys.cate_parentID IS NOT NULL
            UNION
                SELECT 'categorys_all' AS `KEY` ,COUNT(*) AS `VALUE` FROM categorys
            UNION
                SELECT 'posts_public'  AS `KEY` ,COUNT(*) AS `VALUE` FROM posts WHERE posts.post_view_type = 'POST' AND posts.post_trash_admin IS NULL AND  posts.post_status_admin='published'
            UNION
                SELECT 'posts_draft'  AS `KEY` ,COUNT(*) AS `VALUE` FROM posts WHERE posts.post_view_type = 'POST' AND  posts.post_status_admin='draft'
            UNION
                SELECT 'posts_approve'  AS `KEY` ,COUNT(*) AS `VALUE` FROM posts WHERE posts.post_view_type = 'POST' AND  posts.post_approve='approve'
            UNION
                SELECT 'posts_lock'  AS `KEY` ,COUNT(*) AS `VALUE` FROM posts WHERE posts.post_view_type = 'POST' AND  posts.post_status_admin='lock'
            UNION
                SELECT 'posts_trash'  AS `KEY` ,COUNT(*) AS `VALUE` FROM posts
                WHERE posts.post_view_type = 'POST'
                AND  posts.post_trash_admin IS NOT NULL
                AND  posts.post_approve IS NULL
            UNION
                SELECT 'contact'  AS `KEY` ,COUNT(*) AS `VALUE` FROM contact WHERE contact.status = 0
            UNION
                SELECT 'pages'  AS `KEY` ,COUNT(*) AS `VALUE` FROM posts WHERE posts.post_view_type = 'PAGE' AND  posts.post_status='published'
            UNION
                SELECT 'users_admin'  AS `KEY` ,COUNT(*) AS `VALUE` FROM users WHERE users.`type` =  'userAdminCreate'
            UNION
                SELECT 'users_member'  AS `KEY` ,COUNT(*) AS `VALUE` FROM users WHERE users.`type` =  'userCreate'
            UNION
            	SELECT  'db_size_mb' AS `KEY`, ROUND(SUM(data_length + index_length) / 1024 / 1024, 1) AS `VALUE`
						FROM
				    	information_schema.tables
						WHERE
				    	table_schema = DATABASE()
						GROUP BY
    					table_schema
            UNION
                SELECT 'comment'  AS `KEY` ,COUNT(*) AS `VALUE` FROM comments
            ) AS ALL_COUNT

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_count_admin');
    }
}
