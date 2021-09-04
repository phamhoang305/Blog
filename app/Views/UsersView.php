<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class UsersView extends Model
{
    use Sortable;
    protected $table = 'users_view';
    public $sortable = ['id', 'full_name','created_at'];

}
