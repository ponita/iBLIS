<?php

class DataLoggerController extends \BaseController {

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/

	public function in()
	{
 $logger = DataLogger::orderBy('dataAdded', 'DESC')->get();

                        return View::make('datalogger.index')
                        ->with('logger', $logger);

}

public function index(){
		// code...

		//$fromRedirect = Session::pull('fromRedirect');

		$today = Carbon\Carbon::today()->format('Y-m-d');
		//$today = CURDATE();
		$handle = curl_init();

		curl_setopt($handle, CURLOPT_URL,  "https://admin.datapoint.abbott/api/v1/results/GetByDateAdded?StartDate=2019-10-09&amp");
		curl_setopt($handle,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle,CURLOPT_HTTPHEADER, array(
			"Authorization: 4e6034b7bdbdceee66ae1e92bb1ffb3d",
			"Postman-Token: 09bc9c28-4da4-4451-9371-4417e80b3d1a",
			"cache-control: no-cache"
		));

		$response = curl_exec($handle);
		curl_close($handle);
		$content = json_decode($response, true);
		$results = $content['Results'];
		//print_r($results);exit();

		for($i=0; $i<sizeof($results); $i++){

		$d =  DataLogger::firstOrCreate([
				'id' => $results[$i]['Id'],'dataAdded' => $results[$i]['DateAdded'],'DeviceSerialNumber' => $results[$i]['DeviceSerialNumber'],'DeviceType' => $results[$i]['DeviceSerialNumber'],'DeviceTypeString' => $results[$i]['DeviceTypeString'],'Operator' => $results[$i]['Operator'],'SiteName' => $results[$i]['SiteName'],'TestId' => $results[$i]['TestId'],'Sample' => $results[$i]['Sample'],'IsEidSample' => $results[$i]['IsEidSample'],'ResultValue' => $results[$i]['ResultValue'],'SpecimenSource' => $results[$i]['SpecimenSource'],'ResultDate' => $results[$i]['ResultDate'],'ErrorValue' => $results[$i]['ErrorValue'],'SoftwareVersion' => $results[$i]['SoftwareVersion'],'Disease' => $results[$i]['Disease'],'CatridgeType' => $results[$i]['CartridgeType'],'CatridgeId' => $results[$i]['CartridgeId'],'CatridgeLot' => $results[$i]['CartridgeLot'],'CatridgeExpiryDate' => $results[$i]['CartridgeExpiryDate'],'ResultType' => $results[$i]['ResultType'],'HasErrors' => $results[$i]['HasErrors'],'IsSuppressed' => $results[$i]['IsSuppressed'],'Qc' => $results[$i]['Qc'],'DateApproved' => $results[$i]['DateApproved'],'ApprovedBy' => $results[$i]['ApprovedBy'],'ResultStatus' => $results[$i]['ResultStatus'],'ResultStatusString' => $results[$i]['ResultStatusString'],'CatridgeLotNumberAndId' => $results[$i]['CartridgeLotNumberAndId'],'ResultDateString' => $results[$i]['ResultDateString'],'DateAddedString' => $results[$i]['DateAddedString'],'CatridgeTypeString' => $results[$i]['CartridgeTypeString'],'SpecimenSourceString' => $results[$i]['SpecimenSourceString'],'DiseaseString' => $results[$i]['DiseaseString'],'CatridgeExpiryDateString' => $results[$i]['CartridgeExpiryDateString'],'ResultTypeString' => $results[$i]['ResultTypeString']]);
if($d->id)
	$d->save();
			}

			$logger = DataLogger::orderBy('dataAdded', 'DESC')->get();

			return View::make('datalogger.index')
			->with('logger', $logger)
			->with('message','New Data Received');
		}

	public function downloadExcel($type)
		{
		$data = DataLogger::get( [
		'DataAdded'
		,'DeviceSerialNumber'
		,'DeviceType'
		,'DeviceTypeString'
		,'Operator'
		,'SiteName'
		,'TestId'
		,'Sample'
		,'IsEidSample'
		,'ResultValue'
		,'SpecimenSource'
		,'ResultDate'
		,'ErrorValue'
		,'SoftwareVersion'
		,'Disease'
		,'CatridgeType'
		,'CatridgeId'
		,'CatridgeLot'
		,'CatridgeExpiryDate'
		,'ResultType'
		,'HasErrors'
		,'IsSuppressed'
		,'Qc'
		,'DateApproved'
		,'ApprovedBy'
		,'ResultStatus'
		,'ResultStatusString'
		,'CatridgeLotNumberAndId'
		,'ResultDateString'
		,'DateAddedString'
		,'CatridgeTypeString'
		,'SpecimenSourceString'
		,'DiseaseString'
		,'CatridgeExpiryDateString'
		,'ResultTypeString'
		,'dataId',
		])->toArray();

		return Excel::create('Datalogger', function($excel) use ($data)
		{
		  $excel->sheet('mySheet', function($sheet) use ($data)
		      {
		    $sheet->fromArray($data);
		      });
		})->download($type);
		}


		public function create()
		{
			//
		}

		public function store()
		{
			//
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
			//
		}

		/**
		* Update the specified resource in storage.
		*
		* @param  int  $id
		* @return Response
		*/
		public function update($id)
		{
			//
		}

		/**
		* Remove the specified resource from storage.
		*
		* @param  int  $id
		* @return Response
		*/
		public function delete($id)
		{
			//
		}
	}
