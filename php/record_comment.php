<?php


 	require('../tropo.class.php');
 	
 	include_once('../encrypt.php');
 	

/**
 *	TidePools Social WiFi
 *  Copyright (C) 2012 Jonathan Baldwin <jrbaldwin@gmail.com>
 *
 *	This file is part of TidePools <http://www.tidepools.co>

 *  TidePools is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.

 *  TidePools is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.

 *  You should have received a copy of the GNU General Public License
 *  along with TidePools.  If not, see <http://www.gnu.org/licenses/>.
 */

try 
{
    $m = new Mongo(); // connect
    $db = $m->selectDB("Hurricane");
}
catch ( MongoConnectionException $e ) 
{
    echo '<p>Couldn\'t connect to mongodb, is the "mongo" process running?</p>';
    exit();
}
	
	$type = 'landmarks';


	$collection = $db->$type;
	

		
if($_POST['description']) {

    
	//------ SORTING OUT FORM INPUTS ------//
	
	$name = $_POST['name'];
	
	$words = $_POST['description'];
	
	$commenter = $_POST['userID']; //who said that thing?
	
	
	$mongoCommentID = new MongoID();
	
	
//print_r($landmarkID);	
	
 
   	//----Landmark JSON Object------//
					
	$comment = array(
	 
	    'name'=>$name,
	    'words'=>$words,
	    'likes'=>0,
	    'userID'=>$commenter,
	    'mongoCommentID'=>$mongoCommentID
	    

	);
	
	//---------------------------//
	

	
	updateLandmark($comment, $collection);

	//sendSMS($words);
	
	
}


	function updateLandmark($comment, $collection){ 
	
	
		
	
		$landmarkID = $_POST['landmarkID'];
		
		
		
	
		$landmarkID = preg_replace("/[^a-zA-Z0-9\s]/", "", $landmarkID); 
		
		
		$objID = new MongoId($landmarkID);


		$newdata = array('$push' => array("feed" => $comment));
		

		if($collection->update(array("_id"=>$objID), $newdata)){
		
		
			echo "success"; //SHOULD THIS BE A SMS SENT CONFIRMATION in tidepools comment feed?
		
		}
		
		
		sendSMS($comment, $landmarkID);
	}
	
	
	
	function sendSMS($comment, $landmarkID){
	
	
		//$textBody = $comment['words'];
		
		// shorten $textBody to 160 characters (incl. spaces)
	
		//mongo search for landmarkID
		
		//CHECK nested landmark array for smsInfo array ----> if smsInfo !== null { do rest of stuff }   <--- this is to check if this landmark was created via SMS
		
		//inside smsInfo nested array: decrypt phone number with:
		
			// $textPhoneNum = $converter->decode($whoA,$sKey);  <--- following encryption in sms.php

		//setup TROPO auth token 
		
		//send SMS with $textBody via unencrypted phone #
	
	
	
	}
	
	
	




?>