<?php

use Illuminate\Database\Seeder;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Posts;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_categorys= DB::table('categorys')->limit(8)->pluck('id')->toArray();
        $id_categorys = implode("",$id_categorys);
        $id_users= DB::table('users')->limit(9)->pluck('id')->toArray();
        $id_users = implode("",$id_users);

        $faker = \Faker\Factory::create();
        for($i=1;$i<=3;$i++){
            $uniqid = uniqid().uniqid();
            $title = $i==1?'PDO trong PHP - Khái niệm và những thao tác cơ bản':$faker->name." ".$faker->title;
            $row['user_id']=intval(RandomString(1,str_replace('0','',$id_users)));
            $row['category_id']=intval(RandomString(1,$id_categorys));
            $row['post_title'] =$title;
            $row['post_view'] =150+$i;
            $row['uniqid']= $uniqid;
            $row['post_slug'] = SlugService::createSlug(Posts::class, 'post_slug', $row['post_title'],['unique' => true]);
            $row['post_content']=file_get_contents(base_path('public/assets/images/post.html'));
            $row['created_at'] =date('Y-m-d h:s:i');
            $row['updated_at'] =date('Y-m-d h:s:i');
            $row['post_time']=time();
            \File::makeDirectory(public_path("uploads/contents/{$uniqid}"));
            DB::table('posts')->insert($row);
        }
        $uniqid = uniqid().uniqid();
        $postID = DB::table('posts')->insertGetId([
            'post_view_type'=>'PAGE',
            'uniqid'=>$uniqid,
            'post_title'=>'GIỚI THIỆU',
            'post_slug'=>'gioi-thieu',
            'post_content'=>file_get_contents(base_path('public/assets/images/about.html')),
            'created_at'=>date('Y-m-d h:s:i'),
            'updated_at'=>date('Y-m-d h:s:i'),
        ]);
        \File::makeDirectory(public_path("uploads/contents/{$uniqid}"));
    }
}
