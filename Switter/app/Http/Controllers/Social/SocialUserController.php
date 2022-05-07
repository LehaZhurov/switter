<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestUpadateUserPassword;
use App\Http\Requests\UserNamePhotoRequest;
use App\Models\User;
use App\Repositories\SocialUserRepository;
use App\Repositories\SocilaSubersRepository;
use Carbon\Carbon;
use Auth;
use Hash;
class SocialUserController extends Controller
{



    private $SocialUserRepository;

    public function __construct()
    {
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
        $users = $this->SocialUserRepository->getWithUser(1);
        $check = $this->SocilaSubersRepository->getSubers(Auth::id());
        for($i = 0;$i < 1; $i++){
            for($f = 0;$f < count($check); $f++){
            // echo "id bloggera".$check[$f]['blogger_id']." == id user".$user[$i]['id'];
                if($check[$f]['blogger_id'] == $users[$i]['id']){
                $users[$i]['sub'] = "red";
                }

            }

        }
        return view('sub',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = $this->SocialUserRepository->getEditUser($id);
        $users->remember_token = 1;
        $users->save();
        $check = $this->SocilaSubersRepository->getSubers(Auth::id());
            
        return view('user_page',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Возрощает страницу редактирования профиля
        //dd(__METHOD__,$id,);
        $item = $this->SocialUserRepository->getEditUser($id);
        if(empty($item) || $id != Auth::id()){
        return 
            redirect()
            ->route('social.users.show', Auth::id())
            ->with('danger',' Нет пользователя с таким ID');
        }
        return view('user.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestUpadateUserPassword $request, $id)
    {
        //Сохраняет новый пароль
        $item = $this->SocialUserRepository->getEditUser($id);
        $old_pass = Hash::make($request->old_password,);
        $new_pass = Hash::make($request->new_password,);
        if($new_pass != $item->password){//сравниваем новый и старый паполь
            $item->password = $new_pass;//Устанавливаем новый пароль
            $result = $item->save();
            if($result){
                return redirect()
                ->route('social.users.show', Auth::id())
                ->with('success','Пароль успешно изменен');
            }
        }else{
            return redirect()
            ->route('social.users.edit', Auth::id())
            ->with('error','У вас уже установлен это пароль');
        }
        
        
         // dd(__METHOD__,$id,$request);

    }

    public function updateNamePhoto(Request $request, $id)
    {
        //Сохраняет аватра или имя 
        $item = $this->SocialUserRepository->getEditUser($id);
        if(!empty($request->name)){
            $item->name = $request->name;
            $result = $item->save();
            if($result){
                return redirect()
                        ->route('social.users.show', Auth::id())
                        ->with('success',' Имя успешно изменино');
            }
        }
        if ($request->hasFile('photo')) {
        $file = $request->file('photo')->store('/images','public');
        $item->avatar = $file;
    	$item->login_verified_at = new Carbon();
        $result = $item->save();
            if($result){
                return redirect()
                ->route('social.users.show', Auth::id())
                ->with('success',' Фото успешно сохранено');
            }
            //dd(__METHOD__,$id,$request,$item);
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
        
    }

    public function searchUser(Request $request){
        $search = $request->search;
        $users = $this->SocialUserRepository->searchUser($request->search);
        $check = $this->SocilaSubersRepository->getSubers(Auth::id());
        for($i = 0;$i < count($users); $i++){
            for($f = 0;$f < count($check); $f++){
            // echo "id bloggera".$check[$f]['blogger_id']." == id user".$user[$i]['id'];
                if($check[$f]['blogger_id'] == $users[$i]['id']){
                $users[$i]['sub'] = "red";
                }

            }

        }
        return view('user.search',compact('users','search'));
        //dd(__METHOD__,$request->all());
    }

    public function frends($id){
        $user = $this->SocialUserRepository->getEditUser($id);
    	$users = $this->SocialUserRepository->getEditUser($id)->getSuber();
        $check = $this->SocilaSubersRepository->getSubers(Auth::id());
        for($i = 0;$i < count($users); $i++){
            for($f = 0;$f < count($check); $f++){
            // echo "id bloggera".$check[$f]['blogger_id']." == id user".$user[$i]['id'];
                if($check[$f]['blogger_id'] == $users[$i]['id']){
                $users[$i]['sub'] = "red";
                }

            }
        }
    	return view('user.frends',compact('users','user'));
    }

     public function subers($id){
    	$user = $this->SocialUserRepository->getEditUser($id);
        $users = $this->SocialUserRepository->getEditUser($id)->getBlogger();
        $check = $this->SocilaSubersRepository->getSubers(Auth::id());
        for($i = 0;$i < count($users); $i++){
            for($f = 0;$f < count($check); $f++){
            // echo "id bloggera".$check[$f]['blogger_id']." == id user".$user[$i]['id'];
                if($check[$f]['blogger_id'] == $users[$i]['id']){
                $users[$i]['sub'] = "red";
                }

            }
        }
    	 return view('user.suber',compact('users','user'));
    }
}
