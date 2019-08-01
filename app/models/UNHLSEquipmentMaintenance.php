<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UNHLSEquipmentMaintenance extends Model
{
	protected $table = "unhls_equipment_maintenance";



	public function equipment()
	{
		return $this->belongsTo('UNHLSEquipmentInventory');
	}

	public function supplier()
	{
		return $this->belongsTo('UNHLSEquipmentSupplier');
	}

}