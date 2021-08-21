<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class CommentsView extends Model
{
    use Sortable;
    protected $table = 'view_comments';
    public $sortable = ['id', 'full_name','email','comment','post_title','created_at'];
}
