<?
namespace App\Repositories;
use App\Repositories\CoreRepository;
use App\Models\Comment as Model;
class SocialCommentRepository extends CoreRepository
{

	protected function getModelClass()
	{
		return Model::class;
	}

	
	public function GetComments($id_post){
		$result = $this->starConditions()
						->Where('post_id','=',$id_post)
						->get();
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	


}


?>