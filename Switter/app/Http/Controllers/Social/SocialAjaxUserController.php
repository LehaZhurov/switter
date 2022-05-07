<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\SocialUserRepository;
use App\Repositories\SocilaSubersRepository;
use App\Models\SubscrubeUser;
use Auth;
class SocialAjaxUserController extends Controller
{

	private $SocialUserRepository;

    public function __construct()
    {

        $this->SocialUserRepository = app(SocialUserRepository::class);
        $this->SocilaSubersRepository = app(SocilaSubersRepository::class);
    }
    public function UseraUpload($id)
    {   
        if(is_int($id)){
            return response()->json(false, 404);
        }
    	$user = $this->SocialUserRepository->getWithUserAjax(10,$id);
        $check = $this->SocilaSubersRepository->getSubers(Auth::id());
        for($i = 0;$i < 10; $i++){
           // echo  $user[$i]['id']."---";
           for($f = 0;$f < count($check); $f++){
            // echo "id bloggera".$check[$f]['blogger_id']." == id user".$user[$i]['id'];
            if($check[$f]['blogger_id'] == $user[$i]['id']){
                $user[$i]['sub'] = "red";
            }else{
                // $user[$i]['sub'] = "blue";
            }
            // echo "<br>";
            }
        }

    	if($user){
    		return response()->json(array($user), 200);
    	}else{
    		
    	}

    }
    public function UserSubscrube($suber)
    {		
            $sub = new SubscrubeUser();
            $sub->blogger_id = $suber;
            $sub->susbcriber_id  = Auth::id();
            $sub->save();
    }

     public function UserUnSubscrube($suber)
    {
        SubscrubeUser::where('blogger_id', '=', $suber)->orWhere('blogger_id', '=', Auth::id())->delete();
            
    }
}
