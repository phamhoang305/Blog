<?php

namespace App\Models;

use Laravelista\Comments\Commentable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class Testcategory extends Model
{
    use Sortable;
    protected $table = 'test_categorys';
    public $sortable = ['id', 'name','des','order','created_at'];

}
