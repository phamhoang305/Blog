<?php
namespace App\Repositories\Ad;

use App\Repositories\EloquentRepository;
use App\Models\Ad;
use App\Models\Setting;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Cache;
class AdRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Ad::class;
    }
    public function getAdList($request)
    {
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Ad::Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('type', 'LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhere('image', 'LIKE',"%{$search}%");
            })
            ->sortable()
            ->paginate(10);
            return $result;
        }else{
            $result =  Ad::sortable()
            ->paginate(10);
            return $result;
        }
    }
    public function getAdByID($request)
    {
        $result = Ad::where('id','=',$request->id)->first();
        if($result ) return  $result;
        return false;
    }
    public function updateAd($request)
    {
        $setting = Ad::find($request->id);
        $image = $this->uploadImage($request);
        if($image){
            $setting->image = $image;
        }
        $setting->status = $request->status;
        $setting->code = $request->code;
        $setting->url = $request->url;
        $setting->file_image_name = $request->file_image_name;
        if($setting->save()){
            return true;
        }else{
            return false;
        }
    }
    public function uploadImage($request)
    {
        $file      = $request->file("file_ad");
        $result =  Ad::find($request->id);
        $path = "/uploads/ads";
        if ($file) {
            if (\Storage::exists($result->image)) {
                \Storage::delete($result->image);
             }
             $extension = $file->getClientOriginalExtension();
             $picture   = date('Y-m-d-His').'.'.$extension;
             \Storage::putFileAs("{$path}",$file,$picture);
             return  "{$path}/{$picture}";
        }
        return false;
    }
    public function statusAd($request)
    {
        $result =  Ad::find($request->id);
        if($result){
            if($result->status=='on'){
                $result->status = 'off';
            }else{
                $result->status = 'on';
            }
            if($result->save())return true;
            return false;
        }return false;
    }
    public function saveAdSene($request)
    {
        $setting = Setting::find(1);
        $setting->AdSense = $request->AdSense;
        if($setting->save()){
            Cache::forget('setting');
            return true;
        }else{
            return false;
        }
    }
}
