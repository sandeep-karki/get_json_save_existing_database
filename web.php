<?php

use App\Resturant;


Route::get('/', function () {
	$resturantList= Resturant::get();
	foreach ($resturantList as $list) {
		$path = public_path() . "/resturants.json";
		$json = file_get_contents($path);
		$decoded=json_decode($json,true);
		foreach ($decoded["vendors"] as $vendor) {
			if($vendor['LocationLat'] == $list['latitude']){
				// $vendor['OpeningHours'] = $list['openinghours'];
				$list['openinghours'] = $vendor['OpeningHours'];
			}
			$list->save();
		}
	}
});
