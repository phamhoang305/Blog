<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;
use App\Views\CountAdmin;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $countData = CountAdmin::all();
        $data = new \stdClass;
        foreach ($countData as $item) {
                $data->{$item->KEY} = $item->VALUE;
        }

        $disktotal = disk_total_space('/'); //DISK usage
        $disktotalsize = $disktotal / 1073741824;
        $diskfree  = disk_free_space('/');
        $used = $disktotal - $diskfree;
        $diskusedize = $used / 1073741824;
        $diskuse1   = round(100 - (($diskusedize / $disktotalsize) * 100));
        $diskuse = round(100 - ($diskuse1)) . '%';

        $data->diskuse = $diskuse;
        $data->disktotalsize = $disktotalsize;
        $data->diskusedize = $diskusedize;

        View::share('shareAdmin', $data);
    }

}
