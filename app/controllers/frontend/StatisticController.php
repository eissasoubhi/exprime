<?php
namespace frontend;
use View; use Article; use Input; use Redirect; use Validator; use Session; use Email; use Mail; use Statistic; use Request; use DateTime; use Route;
class StatisticController extends \BaseController {

	public function create($request, $response)
	{
		if (Route::current()->getAction()['namespace'] !== "frontend") return false;
		$local_ip = "41.251.169.244"; //Request::getClientIp()
		//for js => http://gd.geobytes.com/gd?after=-1&variables=GeobytesCountry,GeobytesCity   console.log(sGeobytesCountry); console.log(sGeobytesCity);
		$location = json_decode(file_get_contents('http://gd.geobytes.com/GetCityDetails?fqcn='. $local_ip), true);

		$flag = json_decode(file_get_contents('http://map.geoup.com/geoup?template=flag'), true);

		$country = $location['geobytescountry'];
		$city = $location['geobytesregion'];
		$url = Request::url();

		$statistic = Statistic::whereRaw('city = ? And country = ? and url = ?', array($city, $country, $url))->orderBy('time', 'desc');
		if($statistic->exists())
		{
			$statistic = $statistic->get()->first();
			
			$start_date = new DateTime($statistic->time);
			$since_start = $start_date->diff(new DateTime(str_replace("pm", "", date("Y-m-d h:i:s a", time()))));
			
			if ($since_start->h >= 1) {
	 				Statistic::create(array('city' => $city,
							'country' => $country,
							'url' => $url,
							'time' => date("Y-m-d h:i:s a", time()),
							'flag' => $flag,
							'count' => 1));
			 } 
			 else
			 {
			 	$statistic->count++;
			 	$statistic->save();
			 }
			// return dd($since_start);
		}
		else
		{
			Statistic::create(array('city' => $city,
									'country' => $country,
									'url' => $url,
									'time' => date("Y-m-d h:i:s a", time()),
									'flag' => $flag,
									'count' => 1));
		}
	}

}
