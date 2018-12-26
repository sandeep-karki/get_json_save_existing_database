<?php

use App\Resturant;


Route::get('/', function () {
	$resturantList= Resturant::get();
	// dd($resturantList);
	foreach ($resturantList as $list) {
		// dd($list['openinghours']);
		// dd($list['latitude']);
		// dd($list);
		$path = public_path() . "/resturants.json";
		$json = file_get_contents($path);
		$decoded=json_decode($json,true);
		// dd($decoded);
		foreach ($decoded["vendors"] as $vendor) {
			// dd($vendor['OpeningHours']);
			// dd($vendor);
			// dd($vendor['LocationLat']);
			if($vendor['LocationLat'] == $list['latitude']){
				// $vendor['OpeningHours'] = $list['openinghours'];
				$list['openinghours'] = $vendor['OpeningHours'];
			}
			$list->save();
		}
	}
});
