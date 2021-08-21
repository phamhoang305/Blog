<?php

namespace App\Http\Controllers\Comments;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Honeypot\ProtectAgainstSpam;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Comments\CommentControllerInterface;
use App\Models\Users;
// use App\Http\Controllers\Comments\Comment;
// lành
class CommentController extends Controller implements CommentControllerInterface
{
    public function __construct()
    {
        $this->middleware('web');
        Config::set('comments.guest_commenting',setting()->user_login_register_status=='on'?false:true);
        if (Config::get('comments.guest_commenting') == true) {
            $this->middleware('auth')->except('store');
            $this->middleware(ProtectAgainstSpam::class)->only('store');
        } else {
            $this->middleware('auth');
        }
    }

    /**
     * Creates a new comment for given model.
     */
    public function store(Request $request)
    {
        // If guest commenting is turned off, authorize this action.
        if (Config::get('comments.guest_commenting') == false) {
            Gate::authorize('create-comment', Comment::class);
        }

        // Define guest rules if user is not logged in.
        if (!Auth::check()) {
            $guest_rules = [
                'guest_name' => 'required|string|max:255',
                'guest_email' => 'required|string|email|max:255',
            ];
        }
        // Merge guest rules, if any, with normal validation rules.
        Validator::make($request->all(), array_merge($guest_rules ?? [], [
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|string|min:1',
            'message' => 'required|string'
        ]))->validate();
        $model = $request->commentable_type::findOrFail($request->commentable_id);
        $commentClass = Config::get('comments.model');
        $comment = new $commentClass;
        // dd($request->all());
        configMail();
        $mails = array();
        if(setting()->MAIL_RECEIVE==$model->email){
            $mails[]=$model->email;
        }else{
            $mails[]=setting()->MAIL_RECEIVE;
            $mails[]=$model->email;
        }
        if (!Auth::check()) {
            $comment->guest_name = $request->guest_name;
            $comment->guest_email = $request->guest_email;
            $comment_name =$comment->guest_name;
            $comment_email = $comment->guest_email;
        } else {
            $comment->commenter()->associate(Auth::user());
            $comment_name =Auth::user()->full_name;
            $comment_email =Auth::user()->email;
        }
        $comment->commentable()->associate($model);
        $comment->comment = $request->message;
        $comment->approved = !Config::get('comments.approval_required');
        if($comment->save()){
            $rs = _sendMail([
                "template"=>"vendor.mail.comment",
                "data"=>[
                    "comment_name"=>$comment_name,
                    "comment_email"=>$comment_email,
                    "author_name"=>$model->full_name,
                    "author_email"=>$model->email,
                    "comment"=>$comment->comment,
                    'type'=>'store',
                    "url"=>URL::previous() . '#comment-' . $comment->getKey()
                ],
                "mailSend"=>$mails,
                "subject"=>"BÌNH LUẬN BÀI VIẾT"
            ]);
            return Redirect::to(URL::previous() . '#comment-' . $comment->getKey());
        }else{
            return Redirect::to(URL::previous());
        }
    }
    /**
     * Updates the message of the comment.
     */
    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('edit-comment', $comment);

        Validator::make($request->all(), [
            'message' => 'required|string'
        ])->validate();

        $comment->update([
            'comment' => $request->message
        ]);

        return Redirect::to(URL::previous() . '#comment-' . $comment->getKey());
    }

    /**
     * Deletes a comment.
     */
    public function destroy(Comment $comment)
    {

        Gate::authorize('delete-comment', $comment);

        if (Config::get('comments.soft_deletes') == true) {
			$comment->delete();
		}
		else {
			$comment->forceDelete();
		}

        return Redirect::back();
    }

    /**
     * Creates a reply "comment" to a comment.
     */
    public function reply(Request $request, Comment $comment)
    {
        // dd($comment);
        Gate::authorize('reply-to-comment', $comment);

        Validator::make($request->all(), [
            'message' => 'required|string'
        ])->validate();

        $commentClass = Config::get('comments.model');
        $reply = new $commentClass;
        $reply->commenter()->associate(Auth::user());
        $reply->commentable()->associate($comment->commentable);
        $reply->parent()->associate($comment);
        $reply->comment = $request->message;
        $reply->approved = !Config::get('comments.approval_required');

        // dd($comment);


        if($reply->save()){
            if($comment->commenter_id){
                $user = $comment->commenter_type::findOrFail($comment->commenter_id);
                if($user){
                    configMail();
                    $mails = array();
                    if(setting()->MAIL_RECEIVE==$user->email){
                        $mails[]=$user->email;
                    }else{
                        $mails[]=setting()->MAIL_RECEIVE;
                        $mails[]=$user->email;
                    }
                    $comment_name =Auth::user()->full_name;
                    $comment_email =Auth::user()->email;
                    $data = [
                        "comment_name"=>$comment_name,
                        "comment_email"=>$comment_email,
                        "author_name"=>$user->full_name,
                        "author_email"=>$user->email,
                        "comment"=>$reply->comment,
                        'type'=>'reply',
                        "url"=>URL::previous() . '#comment-' . $reply->getKey()
                    ];
                    $rs = _sendMail([
                        "template"=>"vendor.mail.comment",
                        "data"=>$data,
                        "mailSend"=>$mails,
                        "subject"=>"BÌNH LUẬN BÀI VIẾT"
                    ]);
                }
            }else{
                $comment_name =Auth::user()->full_name;
                $comment_email =Auth::user()->email;
                $data = [
                    "comment_name"=>$comment_name,
                        "comment_email"=>$comment_email,
                        "author_name"=>$comment->guest_name,
                        "author_email"=>$comment->guest_email,
                        "comment"=>$reply->comment,
                        'type'=>'reply',
                        "url"=>URL::previous() . '#comment-' . $reply->getKey()
                ];
                $rs = _sendMail([
                    "template"=>"vendor.mail.comment",
                    "data"=>$data,
                    "mailSend"=>[$comment->guest_email],
                    "subject"=>"BÌNH LUẬN BÀI VIẾT"
                ]);
            }

            return Redirect::to(URL::previous() . '#comment-' . $reply->getKey());
        }else{
            return Redirect::to(URL::previous() . '#comment-' . $reply->getKey());
        }
    }
}
