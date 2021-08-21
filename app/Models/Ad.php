<?php

namespace App\Models;

use Laravelista\Comments\Commentable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class Ad extends Model
{
    use Sortable;
    protected $table = 'ad_spaces';
    public $sortable = ['id', 'type','name','update_at'];

}
