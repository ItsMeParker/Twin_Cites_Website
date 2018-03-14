
<!--Author : Alex Foulds-->
<!--Purpose: This is the code that processes the search parameters-->
<?php
//Open the XML file and get the keys for the Flickr api
$xml=simplexml_load_file("information.xml") or die ("ERROR");
$Api_Key = $xml->api_flickr_key;
$sig = $xml->api_flicr_secret;

//Retrieve the values from the form input
$woeid = $_POST['woeid'];
$radius = $_POST['radius'];
$photosNum=$_POST['photosNum'];


//Build the URL with placeholders
$photo_search = 'https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=%s&content_type=1&safe_search=1&woe_id=%s&radius=%s&format=json&nojsoncallback=1';
$url =  sprintf($photo_search, $Api_Key,$woeid,$radius);
$json = file_get_contents($url);
$obj = json_decode($json,true);

if ($obj['stat']=='fail'){
  echo ("ERROR - The WOEID is not valid");
}
elseif ($photosNum < 1) {
  echo ("ERROR - A Number of Photos greater or equal to 1 is required");
}
else{
    //Loop through all returned photos
    $count = (sizeof($obj['photos']['photo'])); //count-1 allows for stat variable in JSON object
    if ($count < $photosNum){
      echo("The requested number of photos is greater than photos for that location");
      $photosNum=$count;
    }
    for ($i=0; $i < $photosNum; $i++) {
    	$id = $obj['photos']['photo'][$i]['id'];
    	$author = $obj['photos']['photo'][$i]['owner'];
    	$title=$obj['photos']['photo'][$i]['title'];
    	if(!$title){
    	  $title="-";
    	}
	
	
    	//Build the URL that will return the photo to the web page
    	$photo_info='https://api.flickr.com/services/rest/?method=flickr.photos.getInfo&api_key=%s&photo_id=%s&format=json&nojsoncallback=1';
    	$photo_info_url = sprintf($photo_info,$Api_Key,$id);
    	$json2 = file_get_contents($photo_info_url);
    	$obj2= json_decode($json2,true);
	
    	//Set the values that can be used to display photo information
    	$farm_id= $obj2['photo']['farm'];
    	$server_id= $obj2['photo']['server'];
    	$id = $obj2['photo']['id'];
    	$secret = $obj2['photo']['secret'];
    	$author_name=$obj2['photo']['owner']['username'];
	
    	//Build the url to the photo itself
    	$picture_url = 'https://farm%d.staticflickr.com/%s/%s_%s.jpg';
    	$pic_link = sprintf($picture_url,$farm_id,$server_id,$id,$secret);
	
	
	
    	if ($i==0){
    	    echo'<div class="row"><div class="img-thumbnail col-xs-12 col-sm-12 col-md-6 col-lg-6"><img class="image" src=', $pic_link,' alt="icon"/><div 	class="caption photoTitle">', $title,'<br/>', $author_name,'</div></div>';
    	}
    	else if (($i%2)==0){
    	    echo'<div class="row"><div class="img-thumbnail col-xs-12 col-sm-12 col-md-6 col-lg-6"><img class="image" src=', $pic_link,' alt="icon"/><div 	class="caption photoTitle">', $title,'<br/>', $author_name,'</div></div>';
    	}
    	else{
    	    //Print the photo on the page, adding the title, author and username underneath
    	    echo'<div class="img-thumbnail col-xs-12 col-sm-12 col-md-6 col-lg-6"><img class="image" src=', $pic_link,' alt="icon"/><div class="caption 	photoTitle">', $title,'<br/>', $author_name,'</div></div></div>';
    	}
    	
    } // end of for
} // end of main

?>

