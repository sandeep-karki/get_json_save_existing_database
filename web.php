<?php

use App\Resturant;


Route::get('/', function () {
	//get data from model
	$resturantList= Resturant::get();
	foreach ($resturantList as $list) {
		//get json data
		$path = public_path() . "/resturants.json";
		$json = file_get_contents($path);
		$decoded=json_decode($json,true);
		foreach ($decoded["vendors"] as $vendor) {
			//matching column data
			if($vendor['LocationLat'] == $list['latitude']){
				//updating the column data
				$list['openinghours'] = $vendor['OpeningHours'];
			}
			$list->save();
		}
	}
});
