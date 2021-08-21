<?php

namespace App\Models;

use Laravelista\Comments\Commentable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class Contact extends Model
{
    use Sortable;
    protected $table = 'contact';
    public $sortable = ['id', 'full_name','email','body','created_at'];

}
