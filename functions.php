<?php
	function get($url) {
	    $ch = curl_init();  
	    curl_setopt($ch,CURLOPT_URL,$url);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $output=curl_exec($ch);
	    curl_close($ch);
	    return $output;
	}

	function get_lat_long($address){
	    $address = str_replace(" ", "+", $address);
	    $json = get("http://maps.google.com/maps/api/geocode/json?address=".$address);
	    $json = json_decode($json);
	    if($json->status =='ZERO_RESULTS'){
	    	echo 'ZERO RESULTS';
	    	exit();
	    }
	    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
	    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
	    return $lat.','.$long;
	}
?>