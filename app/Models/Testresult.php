<?php

namespace App\Models;

use Laravelista\Comments\Commentable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class Testresult extends Model
{
    use Sortable;
    protected $table = 'test_results';
    public $sortable = ['id','created_at'];

}
