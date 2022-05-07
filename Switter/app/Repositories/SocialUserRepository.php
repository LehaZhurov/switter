<?
namespace App\Repositories;
use App\Repositories\CoreRepository;
use App\Models\User as Model;
class SocialUserRepository extends CoreRepository
{

	protected function getModelClass()
	{
		return Model::class;
	}

	public function getWithUser($post)
	{
		$columns = [
			'id',
			'name',
			'avatar',
		];

		$result = $this->starConditions()
						->select($columns)
						->orderBy('id','ASC')
						 // ->with('blogger:id,name')
						->take($post)
						->get();
		return $result;
	}


	public function getEditUser($id)
	{
		return $this->starConditions()->find($id);
	}

	public function getWithUserAjax($post,$id)
	{
		$columns = [
			'id',
			'name',
			'avatar',
		];

		$result = $this->starConditions()
						->select($columns)
						->Where('id','>',$id)
						->take($post)
						->get();
		if($result){
			return $result;
		}else{
			return false;
		}
	}

	public function searchUser($query)
	{
		$columns = [
			'id',
			'name',
			'avatar',
		];

		$result = $this->starConditions()
						->select($columns)
						->Where('name','Like','%'.$query.'%')
						->get();
		if($result){
			return $result;
		}else{
			return false;
		}
	}

	


}


?>