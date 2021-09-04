<?php

namespace App\Models;

use Laravelista\Comments\Commentable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class Posts extends Model
{
    use Sortable;
    use Sluggable;
    // use Commentable;
    protected $table = 'posts';
    public $sortable = ['id', 'post_title','updated_at'];
    public function sluggable(): array
    {
        return [
            'post_slug' => [
                'source' => ['post_title']
            ]
        ];
    }
}
