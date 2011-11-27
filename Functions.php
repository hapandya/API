<?php
//gets JSON File from deal site specified by number of site
  function getJsonFromNet($site, $location){
  	switch ($site){
  	//Groupon = 0
  	case 0:
  			return file_get_contents('http://api.groupon.com/v2/deals.json?division_id='.$location.'&client_id=4a20e1fae1b199fc6512737a313de55d8178bb99');
  	//case 1:
  		
  	//case 2:
  		
  	//case 3:
  	
  	}
  }
 
  //returns json object of the jsontext
  function translateJson($jsontext){
  	return json_decode($jsontext);
  }
  
  function dealArray($arrayType){
  	if($arrayType != null)
  		$array = $arrayType;
  	else
  		$array = "";
  	return $array;
  }
  
  function formatDeal($deal){
  	if($deal->areas != null)
  		$area = $deal->areas[0]->name;
  	else
  		$area = "";
  		
	$tags = dealArray($deal->tags);
	$dealTypes = dealArray($deal->dealTypes);
  	
  	$translateDeal = array("Title" => htmlentities($deal->title, ENT_QUOTES),"Type" => htmlentities($deal->type, ENT_QUOTES),
  							"Area" => $area, "StartAt" => $deal->startAt,
  							"EndAt" => $deal->endAt, "DealType" => $dealTypes,
  							"PitchHtml" => htmlentities($deal->pitchHtml, ENT_QUOTES), "HighlightsHtml" => htmlentities($deal->highlightsHtml, ENT_QUOTES),
  							"SmallImageUrl" => htmlentities($deal->smallImageUrl, ENT_QUOTES), "LargeImageUrl" => htmlentities($deal->largeImageUrl, ENT_QUOTES), 
  							"Merchant" => htmlentities($deal->merchant->name, ENT_QUOTES), "DealUrl" => htmlentities($deal->dealUrl, ENT_QUOTES), "Tags" => $tags,
  							"WebContent" => htmlentities($deal->says->websiteContent, ENT_QUOTES), "grouponID" => htmlentities($deal->says->id, ENT_QUOTES),
  							"AnnouncementTitle" => htmlentities($deal->announcementTitle, ENT_QUOTES), "Price" => htmlentities($deal->options[0]->price->formattedAmount, ENT_QUOTES));
  	return $translateDeal;
  }
  // Connecting to the database //
  function dbconnection() {
  	$con = mysql_connect('localhost','root','');
  	if (!$con) {
  		$error = "Could not connect with a Database" . mysql_error();
  		return $error;
  	}else{
  	 return $con;
  	}
  }
  // Calling function for db connection
  //dbconnection();
  
  // Function to create database
  function createDB($dbcon) {
  	$mydb = 'deals';
  	$dbSelect = "";
  	//$dbcon = dbconnection();
   	if (!mysql_select_db($mydb,$dbcon)){
  		 mysql_query('Create database '.$mydb);
  		 $dbSelect = mysql_select_db($mydb,$dbcon);
  	}
  	return $dbSelect;
  }
  
  function createTable($dbcon) {
  	$tablename="groupondeals";
  	//$dbcon = dbconnection();
  	$sql='CREATE TABLE IF NOT EXISTS '.$tablename.' 
  	(
  	deal_id int(11) NOT NULL AUTO_INCREMENT,
  	title varchar(250),
  	site_type varchar(150),
  	area varchar(100),
  	start_at date,
  	end_at date,
  	deal_type varchar(100),
  	pitch_html text,
  	highlights_html text,
  	small_image_url varchar(100),
  	large_image_url varchar(100),
  	merchant varchar(50),
  	deal_url varchar(100),
  	tags varchar(100),
  	webcontent text,
  	groupon_id int(11),
  	announcement_title varchar(100),
  	price float(4.2),
  	PRIMARY KEY(deal_id)
  	)';
  	$rs = mysql_query($sql,$dbcon);
  	return $rs;
  }
  
  function insertDeals($formatDeal,$createTable) {
  	$tablename="groupondeals";
  	$translateDeal = $formatDeal;
//  	print_r($translateDeal);
  	if ($createTable!=0) {
  		$sql = "INSERT INTO ".$tablename." 
  		(deal_id, title, site_type, area, start_at, end_at, deal_type, pitch_html, highlights_html,
  		small_image_url, large_image_url, merchant, deal_url, tags, webcontent, groupon_id, announcement_title, price)
  		Values
  		('','".htmlentities($translateDeal['Title'])."','".htmlentities($translateDeal['Type'])."','".$translateDeal['Area']."','".$translateDeal['StartAt']."','".$translateDeal['EndAt']."','".$translateDeal['DealType']."','".htmlentities($translateDeal['PitchHtml'])."',
  		'".htmlentities($translateDeal['HighlightsHtml'])."','".htmlentities($translateDeal['SmallImageUrl'])."','".htmlentities($translateDeal['LargeImageUrl'])."','".htmlentities($translateDeal['Merchant'])."','".htmlentities($translateDeal['DealUrl'])."','".$translateDeal['Tags']."','".htmlentities($translateDeal['WebContent'])."',
  		'".htmlentities($translateDeal['grouponID'])."','".htmlentities($translateDeal['AnnouncementTitle'])."','".htmlentities($translateDeal['Price'])."'
  		)";
  		$rs = mysql_query($sql);
  		if ($rs!=0) {
  			return true;
  		}else{
  			return false;	
  		}
  	}
  }
  
  function selectDeals() {
  	$tablename="groupondeals";
  	echo $sql = "SELECT * FROM " .$tablename. " ORDER BY start_at"; die;
 	$rs = mysql_query($sql);
  		if ($rs!=0) {
  			return true;
  		}else{
  			return false;	
  		}
  }
  ?>
  