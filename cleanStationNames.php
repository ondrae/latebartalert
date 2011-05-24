<?php
function cleanStationNames($lastAlert){
	//Set cases
	$twoWordStations = array('City', 'Point', 'Francisco', 'Bay', 'Fair', 'Park', 'Center', 'Airport', 'Berkeley', 'Merritt', 'Concord/Martinez', 'Bruno', 'Leandro', 'Hayward', 'Creek', 'Dublin/Pleasanton', 'Oakland');
	$threeWordStations = array('St.', 'Center/UN', 'Cerrito');
	//Loop through alert looking for stations names
	for($i=0;$i<count($lastAlert);$i++){
		for($x=0;$x<count($twoWordStations);$x++){
			if($lastAlert[$i]==$twoWordStations[$x]){
				$lastAlert[$i-1] = $lastAlert[$i-1]." ".$lastAlert[$i];
				unset($lastAlert[$i]);
			}
		}
		for($a=0;$a<count($threeWordStations);$a++){
			if($lastAlert[$i]==$threeWordStations[$a]){
				$lastAlert[$i-1] = $lastAlert[$i-1]." ".$lastAlert[$i]." ".$lastAlert[$i+1];
				unset($lastAlert[$i]);
				unset($lastAlert[$i+1]);
			}
		}
		if($lastAlert[$i]=='South'){
			if($lastAlert[$i+1]=='San'){
				if($lastAlert[$i+2]=='Francisco'){
					$lastAlert[$i] = $lastAlert[$i]." ".$lastAlert[$i+1]." ".$lastAlert[$i+2];
			unset($lastAlert[$i+1]);
			unset($lastAlert[$i+2]);
				}
			}
		}
		if($lastAlert[$i]=='San'){
			if($lastAlert[$i+1]=='Francisco'){
				if($lastAlert[$i+2]=='Int\'l'){
					$lastAlert[$i] = $lastAlert[$i]." ".$lastAlert[$i+1]." ".$lastAlert[$i+2]." ".$lastAlert[$i+3];
			unset($lastAlert[$i+1]);
			unset($lastAlert[$i+2]);
			unset($lastAlert[$i+3]);
				}
			}
		}
		if($lastAlert[$i]=='Powell'){
			if($lastAlert[$i+1]=='St.'){
				$lastAlert[$i] = $lastAlert[$i]." ".$lastAlert[$i+1];
				unset($lastAlert[$i+1]);
				}
			}		
		}
	return $lastAlert;
	}	
?>