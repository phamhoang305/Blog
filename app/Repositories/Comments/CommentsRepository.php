<?php
namespace App\Repositories\Comments;

use App\Repositories\EloquentRepository;
use App\Views\CommentsView;
use App\Models\Comments;
use Cviebrock\EloquentSluggable\Services\SlugService;
class CommentsRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Comments::class;
    }
    public function getCommentsList($request)
    {
        if(!empty($request->q)){
            $search = $request->q;
            $result =  CommentsView::Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('comment', 'LIKE',"%{$search}%")
                ->orWhere('full_name', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('comments.created_at', 'LIKE',"%{$search}%");
            })
            ->sortable()
            ->paginate(10);
            return $result;
        }else{
            $result =  CommentsView::sortable()
            ->paginate(10);
            return $result;
        }
    }
    public function deleteComments($request)
    {
        $ids = json_decode($request->idArray);
        $Comments = Comments::whereIn('id',$ids);
        if($Comments->delete()){
            return true;
        }return false;
    }

}
