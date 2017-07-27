<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />

  <title>Flickr-geo-search</title>

	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<h2>Flickr-geo-search</h2>
	<div id="search">
		<form method="post" >
			<input type="text" name="location">
			<input type="submit" name="Go" value="Go">
		</form>
	</div>


	<?php
		include 'functions.php';
		if( isset($_POST['location']) && $_POST['location'] != '' ) {
			extract($_POST);
			// Get lat long from google
			$latlong    =   get_lat_long($location); // create a function with the name "get_lat_long" given as below
			$map        =   explode(',' ,$latlong);
			$mapLat     =  number_format((float)$map[0], 1, '.', '') ;
			$mapLong    =  number_format((float)$map[1], 1, '.', '');  
			$response=file_get_contents('https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=74a69e271edec1fa59f42ea7673e46bb&lat='.$mapLat.'&lon='.$mapLong.'&accuracy=14&format=json&nojsoncallback=1');
			$response=json_decode($response);
			$photo_array = $response->photos->photo;
			foreach($photo_array as $single_photo){
				$farm_id = $single_photo->farm;
				$server_id = $single_photo->server;
				$photo_id = $single_photo->id;
				$secret_id = $single_photo->secret;
				$size = 'm';
				$title = $single_photo->title;
				$photo_url = 'https://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'_'.$size.'.'.'jpg';
				echo' <img src="'.$photo_url.'"  />';
			}
		}	
	?>
	
	
</html>