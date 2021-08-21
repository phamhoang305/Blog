<?php

namespace App\Models;

use Laravelista\Comments\Commentable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class Testlist extends Model
{
    use Sortable;
    protected $table = 'test_lists';
    public $sortable = ['id', 'testlist_name','testlist_des','testlist_order','created_at'];

}
