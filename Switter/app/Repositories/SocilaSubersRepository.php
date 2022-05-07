<?
namespace App\Repositories;
use App\Repositories\CoreRepository;
use App\Models\SubscrubeUser as Model;
use Auth;
class SocilaSubersRepository extends CoreRepository
{

	protected function getModelClass()
	{
		return Model::class;
	}

	public function getSubers($suber)
	{

		$columns = [
			'id',
			'blogger_id',
			'susbcriber_id',
		];
		$result = $this->starConditions()
						->select($columns)
						->where([
  								['susbcriber_id', '=', $suber],
								])
						->get();
		if($result){
			return $result;
		}else{
			return true;
		}
	}

	public function getBloggers($suber)
	{

		$columns = [
			'id',
			'blogger_id',
			'susbcriber_id',
		];
		$result = $this->starConditions()
						->select($columns)
						->where([
  								['susbcriber_id', '=', $suber],
								])
						->pluck('blogger_id');
				
		if($result){
			return $result;
		}else{
			return true;
		}
	}
}
?>