<?php 
// $query = "INSERT INTO movies(name, language, country, genres, relaseDate, imdbRating, poster, cast, director, musicDirector, trailer, aboutMovie) VALUES ('$name','$language','$country', '$genre', '$rdate', '$rating','$poster','$cast','$director','$mdirector','$trailer','$about')";

// $result=$con->query($query);

 // function getaddress($lat,$lng)
 // {
 //    $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
 //    $json = file_get_contents($url);
 //    $data=json_decode($json);
 //    $status = $data->status;
 // }
  	

	// GET IP

	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}

	
	$query = "SELECT * FROM visitlogs WHERE ip='$ip'";
	$result = $db->select($query);
	
	if ($result) {

	}

	else{


		// GET Country , City
	  	$user_ip = '58.84.33.65';
	  	$geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=$user_ip'));

	 	$country_code = $geo['geoplugin_countryCode'];
	  	$country_name = $geo['geoplugin_countryName'];

	  	$lat = $geo['geoplugin_latitude'];
	  	$lng = $geo['geoplugin_longitude'];
	 
		$data = file_get_contents("http://maps.google.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=false");
		$data = json_decode($data);
		$add_array  = $data->results;
		$add_array = $add_array[0];
		$add_array = $add_array->address_components;
		foreach ($add_array as $key) {
		  if($key->types[0] == 'administrative_area_level_2')
		  {
		    $city = $key->long_name;
		  }
		}


		// Browser Info
		$getbrowser = get_browser(null, true);
		$browser =  $getbrowser['browser'];


		// OS INFO
		$uagent = $_SERVER['HTTP_USER_AGENT'] . "<br/>";

		function os_info($uagent)
		{
		    // the order of this array is important
			global $uagent;
			$oses   = array(
				'Win311' => 'Win16',
				'Win95' => '(Windows 95)|(Win95)|(Windows_95)',
				'WinME' => '(Windows 98)|(Win 9x 4.90)|(Windows ME)',
				'Win98' => '(Windows 98)|(Win98)',
				'Win2000' => '(Windows NT 5.0)|(Windows 2000)',
				'WinXP' => '(Windows NT 5.1)|(Windows XP)',
				'WinServer2003' => '(Windows NT 5.2)',
				'WinVista' => '(Windows NT 6.0)',
				'Windows 7' => '(Windows NT 6.1)',
				'Windows 8' => '(Windows NT 6.2)',
				'Windows 8.1' => '(Windows NT 6.3)',
				'Windows 10' => '(Windows NT 10.0)',
				'WinNT' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
				'OpenBSD' => 'OpenBSD',
				'SunOS' => 'SunOS',
				'Ubuntu' => 'Ubuntu',
				'Android' => 'Android',
				'Linux' => '(Linux)|(X11)',
				'iPhone' => 'iPhone',
				'iPad' => 'iPad',
				'MacOS' => '(Mac_PowerPC)|(Macintosh)',
				'QNX' => 'QNX',
				'BeOS' => 'BeOS',
				'OS2' => 'OS/2',
				'SearchBot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
			);
			$uagent = strtolower($uagent ? $uagent : $_SERVER['HTTP_USER_AGENT']);
			foreach ($oses as $os => $pattern)
				if (preg_match('/' . $pattern . '/i', $uagent))
					return $os;
				return 'Unknown';
		}		
		$os = os_info($uagent);

	
		$query = "INSERT INTO visitlogs(ip, browser, os, country_code, country_name, city, latitude, longitude) VALUES ('$ip','$browser','$os', '$country_code', '$country_name', '$city','$lat','$lng')";
		$result = $db->create($query);
	}
 ?>