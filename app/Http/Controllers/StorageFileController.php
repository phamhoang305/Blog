<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use File;
class StorageFileController extends Controller
{
    public function storgeFilePost($filename)
    {
        $decrypted_string = \Illuminate\Support\Facades\Crypt::decrypt($filename);
        $path = storage_path("app/public/{$decrypted_string}");
        if (!File::exists($path)) { abort(404);}
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;

    }

}
