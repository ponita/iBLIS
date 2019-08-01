<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class UNHLSFacilityOwnership extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'unhls_facility_ownership';

	public function facility()
	{
		return $this->hasMany('UNHLSFacility', 'level_id', 'id');
	}
	

}