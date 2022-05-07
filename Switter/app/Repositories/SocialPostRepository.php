<?
namespace App\Repositories;
use App\Repositories\CoreRepository;
use App\Models\Post as Model;
use Carbon\Carbon;
class SocialPostRepository extends CoreRepository
{

	protected function getModelClass()
	{
		return Model::class;
	}

	public function getWithPostsAjax($id)
	{
		$columns = [
			'id',
			'content_raw',
			'photo_post',
			'publushed_at',
			'user_id'
		];

		$result = $this->starConditions()
						->select($columns)
						->Where('user_id','=',$id)
						->get();
		if($result){
			return $result;
		}else{
			return false;
		}
	}

	public function getEditPost($id)
	{
		return $this->starConditions()->find($id);
	}

	public function NewsPost($skip,$id,$limit = 1)
	{

		$dayslater = Carbon::now()->subDay(5);
		$columns = [
			'id',
			'content_raw',
			'photo_post',
			'user_id',
			'publushed_at',
			'created_at'
		];
			$result = $this->starConditions()
							->select($columns)
							->whereIn('user_id',$id)
							->whereDate('created_at','>',$dayslater)
							->offset($skip)
							->limit($limit)
							->get();
		if($result){
			return $result;
		}else{
			return false;
		}
	}


}


?>