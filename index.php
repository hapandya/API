<?php
  	include 'Functions.php';
	$site = 0;
//	$url = 'http://api.groupon.com/v2/deals.json?division_id=san-francisco&client_id=4a20e1fae1b199fc6512737a313de55d8178bb99';
//	$location = getLocation($url);
	//print_r($location);
	$location = "san-francisco";
	$jsonText = getJsonFromNet($site,$location);
  	$jsonobject = translateJson($jsonText);
   	//print_r($jsonobject);die;
   	$dbcon = dbconnection();
   	$creatdb = createDB($dbcon);
   	$createTable = createTable($dbcon);
  	$i = 0;
  	foreach($jsonobject->deals as $deals){
  		$formatDeal = formatDeal($deals);
  		//$insertDeals = insertDeals($formatDeal,$createTable);
  		
  		$insertDeals = TRUE;
  		if ($insertDeals==TRUE) {
  			echo "***********  Inserted Deal is: ************ <br />";
  			echo "Deal #: ". $i. "<br />";
  			echo "Title:-".$deals->title."<br />";
  			echo "Type:-".$deals->type."<br />";
  			echo "Start At:-".$deals->startAt."<br />";
  			if($deals->areas != null)
  				echo $deals->areas[0]->name."<br /><br />";
  				else
  			echo "<br />";
  		$i++;
  		}else{
  			echo "Sorry Deals are not inserted Please check your code.";
  		}
  		$getDeals = selectDeals();
  	}
  		
 ?>