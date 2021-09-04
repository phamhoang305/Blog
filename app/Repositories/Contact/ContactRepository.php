<?php
namespace App\Repositories\Contact;

use App\Repositories\EloquentRepository;
use App\Models\Contact;
use Cviebrock\EloquentSluggable\Services\SlugService;
class ContactRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Contact::class;
    }
    public function getListContractDasboard($limit = 10)
    {
        return Contact::Where('status','=',0)->limit($limit)->get();
    }
    public function sendContact($request)
    {
        $Contact = new Contact();
        $Contact->full_name = $request->full_name;
        $Contact->email = $request->email;
        $Contact->body = $request->body;
        if($Contact->save()){
            configMail();
            $this->senMail($request);
            return true;
        }return false;
    }
    public function senMail($request)
    {
        _sendMail([
            "template"=>"web.pages.contact.template",
            "data"=>[
                "full_name"=>$request->full_name,
                "email"=>$request->email,
                "body"=>$request->body,
            ],
            "mailSend"=>[setting()->MAIL_RECEIVE],
            "subject"=>"MAIL LIÊN HỆ"
        ]);
    }
    public function getContactList($request)
    {
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Contact::Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('full_name', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('body', 'LIKE',"%{$search}%")
                ->orWhere('created_at', 'LIKE',"%{$search}%");
            })
            ->sortable()
            ->paginate(10);
            return $result;
        }else{
            $result =  Contact::sortable()
            ->paginate(10);
            return $result;
        }

    }
    public function deleteContact($request)
    {
        $ids = json_decode($request->idArray);
        $Contact = Contact::whereIn('id',$ids);
        // dd($Contact);
        if($Contact->delete()){
            return true;
        }return false;

    }
    public function getContactByID($request)
    {
        $Contact = Contact::where('id',$request->id)->first();
        if($Contact->status==0){
            $Contact->status=1;
            $Contact->save();
        }
        return $Contact;
    }
}
