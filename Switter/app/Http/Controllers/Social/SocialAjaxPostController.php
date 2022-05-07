<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\SocialPostRepository;
use App\Repositories\SocialUserRepository;
use App\Repositories\SocilaSubersRepository;
use Auth;
class SocialAjaxPostController extends Controller
{

	private $SocialUserRepository;
	private $SocialPostRepository;
    private $SocilaSubersRepository;
    private $skip = 10;
    public function __construct()
    {
        $this->SocialPostRepository = app(SocialPostRepository::class);
        $this->SocialUserRepository = app(SocialUserRepository::class);
        $this->SocilaSubersRepository = app(SocilaSubersRepository::class);
    }
    public function PostsUpload($id)
    {
    	$post ['data']= $this->SocialPostRepository->getWithPostsAjax($id);
        $post ['lenght'] = count($post['data']);
        
    	if($post){
    		return response()->json($post, 200);
    	}else{
    		return response()->json(false, 100);
    	}

    }

    public function NewsUpload($skip){
    	$suber = $this->SocilaSubersRepository->getBloggers(Auth::id());
      	$posts = $this->SocialPostRepository->NewsPost($skip,$suber);
      		$user = $this->SocialUserRepository->getEditUser($posts[0]['user_id']);
      		$posts[0]['user_name'] = $user->name;
      		$posts[0]['user_avatar'] = $user->avatar;
            
      	if($posts){
    		return response()->json($posts, 200);
    	}else{
    		return response()->json(false, 100);
    	}
    }

    public function Post($id){
        $posts = $this->SocialPostRepository->getEditPost($id);
        $user = $this->SocialUserRepository->getEditUser($posts['user_id']);
            $posts['user_name'] = $user->name;
            $posts['user_avatar'] = $user->avatar;
        if($posts){
            return response()->json($posts, 200);
        }else{
            return response()->json(false, 100);
        }
    }


}