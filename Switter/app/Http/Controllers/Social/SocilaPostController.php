<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Repositories\SocialPostRepository;
use App\Repositories\SocialUserRepository;
use App\Repositories\SocilaSubersRepository;
use Auth;
use Hash;
use Carbon\Carbon;
use App\Http\Requests\CreatePostRequest;
class SocilaPostController extends Controller
{


    private $SocialPostRepository;
    private $SocialUserRepository;
    private $SocilaSubersRepository;
    public function __construct()
    {

        $this->SocialPostRepository = app(SocialPostRepository::class);
        $this->SocialUserRepository = app(SocialUserRepository::class);
        $this->SocilaSubersRepository = app(SocilaSubersRepository::class);

        
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = new Post();
        $time = new Carbon();
        $post->title = 'post user'.Auth::id();//Заголовок поста не нужен пока 
        $post->content_raw = $request->text_post;//Текст поста 
        if ($request->hasFile('images_post')) {
        $file = $request->file('images_post')->store('/images','public');
        $post->photo_post = $file;
        }else{
        	$post->photo_post = "";
        }
        $post->slug = $time->format('Y.m.d/H:i:s');
        $post->publushed_at = $time->format('Y.m.d/H:i');
        $post->user_id = Auth::id();//айди пользователя 
        $result = $post->save();//Сохраняем пост в БД
            if($result){
                return redirect()
                ->route('social.users.show', Auth::id())
                ->with('success','Запись опубликована');
            }
            //dd(__METHOD__,$id,$request,$item);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->SocialPostRepository->getEditPost($id);
        $user = $this->SocialUserRepository->getEditUser(Auth::id());
         if(empty($post)){
         	return redirect()
            ->route('social.users.show', Auth::id())
            ->with('danger','Запись не найдена');
         }else{
         	if($post->user_id != Auth::id()){
         		return redirect()
                ->route('social.users.show', Auth::id())
                ->with('danger','Запись не найдена');
         	}else{
        		return view('post.edit',compact('post','user'));
         	}
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, $id)
    {	

        $post = $this->SocialPostRepository->getEditPost($id);
    	$post->content_raw = $request->content_raw;
    	if($request->hasFile('images_post')){
    		$file = $request->file('images_post')->store('/images','public');
        	$post->photo_post = $file;
    	}
        $post->updated_at = new Carbon();
        $post->save();
        if($post){
        	return redirect()
            ->route('social.users.show', Auth::id())
            ->with('success','Запись обновлена');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Post::destroy($id);
        if($result){
        	return redirect()
            ->route('social.users.show', Auth::id())
            ->with('success','Запись удалена');
        }else{
        	dd($result);
        }
    }
    public function news()
    {	

    	$suber = $this->SocilaSubersRepository->getBloggers(Auth::id());
      	$posts = $this->SocialPostRepository->NewsPost(0,$suber,10);
      	for($i=0;$i<count($posts);$i++){
      		$user = $this->SocialUserRepository->getEditUser($posts[$i]['user_id']);
      		$posts[$i]['user_name'] = $user->name;
      		$posts[$i]['user_avatar'] = $user->avatar;
      	}
      	//dd($suber,$posts);

      return view('post.news',compact('posts'));
    }
}
