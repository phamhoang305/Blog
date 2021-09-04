<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;
class PostsView extends Model
{
    use Commentable;
    protected $table = 'view_posts';
    protected $primaryKey = 'id';
}
