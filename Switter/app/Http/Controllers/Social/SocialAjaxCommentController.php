<?php

namespace App\Http\Controllers\Social;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Repositories\SocialCommentRepository;
use App\Repositories\SocialUserRepository;

use Auth;
class SocialAjaxCommentController extends Controller
{
	private $SocialCommentRepository;
	private $SocialUserRepository;


    public function __construct()
    {

        $this->SocialCommentRepository = app(SocialCommentRepository::class);
        $this->SocialUserRepository = app(SocialUserRepository::class);
    }
    public function SaveComment($id_post,$text)
    {
    	$model = new Comment;
    	$time = new Carbon;
    	$model->comment = $text;
    	$model->publushed_at = $time->format('Y.m.d/H:i');
    	$model->user_id = Auth::id();
    	$model->post_id = $id_post;
    	$model->save();

    }

    public function SendComments($id_post){
    	$result = $this->SocialCommentRepository->GetComments($id_post);
    		// dd($result);
    	for ($i=0; $i < count($result); $i++) { 
    		$user = $this->SocialUserRepository->getEditUser($result[$i]->user_id);
    		$result[$i]->user_name = $user->name;
    		$result[$i]->user_avatar = $user->avatar;
    	}
    	if($result){
    		return response()->json(array($result), 200);
    	}else{
    		return response()->json(array($result), 404);
    	}
    }
}
