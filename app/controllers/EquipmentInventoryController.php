<?php

class EquipmentInventoryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$items = UNHLSEquipmentInventory::get();
		$procurement_type = array('0' => 'Placement', '1' => 'Procured','2'=>'Donation');
		//$location = array('0' => 'Chemistry', '1' => 'Microbiology', '2' => 'Mycology','3' => 'Heamatology', '4' => 'Serology', '5' => 'Blood Transfusion', '6' => 'Immunology', '7' => 'Ecology', '8' => 'Parasitology', '9' => 'Pathology');

		$location = TestCategory::get(['name','id'])->lists('name','id');

		$yes_no = array('1' => 'Yes', '0' => 'No');
		$service_frequency = array('0' => '3 months', '1' => '6 months', '2' => '9 months', '4' => '12 months');

		return View::make('equipment.inventory.index')
					->with('items',$items)
					->with('procurement_type',$procurement_type)
					->with('location',$location)
					->with('service_frequency',$service_frequency)
					->with('yes_no',$yes_no);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$procurement_type_list = array('0' => 'Placement', '1' => 'Procured');
		
		$location_list = TestCategory::get(['name','id'])->lists('name','id');

		$service_frequency_list = array('0' => '3 months', '1' => '6 months', '2' => '9 months', '4' => '12 months');

		$warranty_list = array('0' => '6 months','1' => '1 year', '2' => '2 years', '3' => '3 years', '4' => '4 years', '5' => '5 years');
		$lt = new Lookup();
        $lt->name = 'EQUIPMENT_NAMES';
        $equipment_names = array_merge_maintain_keys(array('' => 'Select one'),$lt->getOptionValuesAndDescription());

        $lt->name = 'YES_NO';
        $yes_no_list = $lt->getOptionValuesAndDescription();

		$supplier_list = UNHLSEquipmentSupplier::get(['name','id'])->lists('name','id');

		return View::make('equipment.inventory.create')
					->with('service_frequency_list',$service_frequency_list)
					->with('yes_no_list',$yes_no_list)
					->with('procurement_type_list',$procurement_type_list)
					->with('location_list',$location_list)
					->with('warranty_list',$warranty_list)
					->with('supplier_list',$supplier_list)
					->with('equipment_names', $equipment_names);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		//
		$rules = array(
		'name_id' => 'required',
		'model' => 'required',
		'unique_number' => 'required',
		'serial_number' => 'required',
		'location' => 'required',
		'procurement_type' => 'required',
		'purchase_date' => 'required',
		'delivery_date' => 'required',
		'verification_date' => 'required',
		'installation_date' => 'required',
		'spare_parts' => 'required',
		'warranty' => 'required',
		'life_time' => 'required',
		'service_frequency' => 'required',
		'supplier_id' => 'required',
		'service_contract' => 'required'

		);
		$lt = new Lookup();
        $lt->name = 'EQUIPMENT_NAMES';
        $equipment_names = array_merge_maintain_keys(array('' => 'Select one'),$lt->getOptionValuesAndDescription());

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		} else {

			$item = new UNHLSEquipmentInventory;

        	$item->district_id = \Config::get('constants.DISTRICT_ID') ;
        	$item->facility_id = \Config::get('constants.FACILITY_ID');
        	$item->year_id = \Config::get('constants.FIN_YEAR_ID');  

			$item->name = $equipment_names[Input::get('name_id')];
			$item->name_id = Input::get('name_id');
			$item->unique_number = Input::get('unique_number');
			$item->model = Input::get('model');
			$item->serial_number = Input::get('serial_number');
			$item->location = Input::get('location');
			$item->procurement_type = Input::get('procurement_type');
			$item->purchase_date = Input::get('purchase_date');
			$item->delivery_date = Input::get('delivery_date');
			$item->verification_date = Input::get('verification_date');
			$item->installation_date = Input::get('installation_date');
			$item->spare_parts = Input::get('spare_parts');
			$item->warranty = Input::get('warranty');
			$item->life_span = Input::get('life_time');
			$item->service_frequency = Input::get('service_frequency');
			$item->supplier_id = Input::get('supplier_id');
			$item->service_contract = Input::get('service_contract');

			$item->save();

			return Redirect::to('equipmentinventory');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$procurement_type_list = array('0' => 'Placement', '1' => 'Procured');
		$service_frequency_list = array('0' => '3 months', '1' => '6 months', '2' => '9 months', '4' => '12 months');

		$warranty_list = array('0' => '6 months','1' => '1 year', '2' => '2 years', '3' => '3 years', '4' => '4 years', '5' => '5 years');
		
		$lt = new Lookup();
        $lt->name = 'EQUIPMENT_NAMES';
        $equipment_names = array_merge_maintain_keys(array('' => 'Select one'),$lt->getOptionValuesAndDescription());
        
        $equipment = UNHLSEquipmentInventory::find($id);

        $lt->name = 'YES_NO';
        $yes_no_list = $lt->getOptionValuesAndDescription();

		$supplier_list = UNHLSEquipmentSupplier::get(['name','id'])->lists('name','id');

		$location_list = TestCategory::get(['name','id'])->lists('name','id');

		return View::make('equipment.inventory.edit_equipment')
					->with('service_frequency_list',$service_frequency_list)
					->with('yes_no_list',$yes_no_list)
					->with('procurement_type_list',$procurement_type_list)
					->with('location_list',$location_list)
					->with('warranty_list',$warranty_list)
					->with('supplier_list',$supplier_list)
					->with('equipment_names', $equipment_names)
					->with('equipment',$equipment);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
		'name_id' => 'required',
		'model' => 'required',
		'unique_number' => 'required',
		'serial_number' => 'required',
		'location' => 'required',
		'procurement_type' => 'required',
		'purchase_date' => 'required',
		'delivery_date' => 'required',
		'verification_date' => 'required',
		'installation_date' => 'required',
		'spare_parts' => 'required',
		'warranty' => 'required',
		'service_frequency' => 'required',
		'supplier_id' => 'required',
		'service_contract' => 'required'

		);
		$lt = new Lookup();
        $lt->name = 'EQUIPMENT_NAMES';
        $equipment_names = array_merge_maintain_keys(array('' => 'Select one'),$lt->getOptionValuesAndDescription());

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		} else {

			$item = UNHLSEquipmentInventory::find($id);

        	$item->district_id = \Config::get('constants.DISTRICT_ID') ;
        	$item->facility_id = \Config::get('constants.FACILITY_ID');
        	$item->year_id = \Config::get('constants.FIN_YEAR_ID');  

			$item->name = $equipment_names[Input::get('name_id')];
			$item->name_id = Input::get('name_id');
			$item->unique_number = Input::get('unique_number');
			$item->model = Input::get('model');
			$item->serial_number = Input::get('serial_number');
			$item->location = Input::get('location');
			$item->procurement_type = Input::get('procurement_type');
			$item->purchase_date = Input::get('purchase_date');
			$item->delivery_date = Input::get('delivery_date');
			$item->verification_date = Input::get('verification_date');
			$item->installation_date = Input::get('installation_date');
			$item->spare_parts = Input::get('spare_parts');
			$item->warranty = Input::get('warranty');
			$item->life_span = Input::get('life_time');
			$item->service_frequency = Input::get('service_frequency');
			$item->supplier_id = Input::get('supplier_id');
			$item->service_contract = Input::get('service_contract');

			$item->save();
		}

			return Redirect::to('equipmentinventory');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$item = UNHLSEquipmentInventory::find($id);
		$item->delete();
		return Redirect::to('equipmentinventory');
	}


}
