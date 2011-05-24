<?php
for($i=0;$i<count($lastAlert);$i++){
		$twoWordStations = array('City', 'Point', 'Francisco', 'Bay', 'Fair', 'Park', 'Center', 'Airport', 'Berkeley', 'Merritt', 'Concord/Martinez', 'Bruno', 'Leandro', 'Hayward', 'Creek', 'Dublin/Pleasanton', 'Oakland'); 
		for($x==0;$i<count($twoWordStations);$i++){
			if($lastAlert[$i]==$twoWordStations[$i]){
				$lastAlert[$i-1] = $lastAlert[$i-1]." ".$lastAlert[$i];
				unset($lastAlert[$i]);
			}
		}
		$threeWordStations = array('St.', 'Center/UN', 'Cerrito');
		for($a==0;$i<count($threeWordStations);$i++){
			if($lastAlert[$i]==$threeWordStations[$i]){
				$lastAlert[$i-1] = $lastAlert[$i-1]." ".$lastAlert[$i]." ".$lastAlert[$i+1];
				unset($lastAlert[$i]);
				unset($lastAlert[$i+1]);
				//echo "!!!".$lastAlert[$i];
			}
		}
	}/*
		if(($lastAlert[$i]=='Powell')&&($lastAlert[$i+1]=='St.')){
			$lastAlert[$i] = $lastAlert[$i]." ".$lastAlert[$i+1];
			unset($lastAlert[$i+1]);
			}
		if(($lastAlert[$i]=='South')&&($lastAlert[$i+1]=='San')&&($lastAlert[$i+2]=='Francisco')){
			$lastAlert[$i] = $lastAlert[$i]." ".$lastAlert[$i+1]." ".$lastAlert[$i+2];
			unset($lastAlert[$i+1]);
			unset($lastAlert[$i+2]);
			}
		if(($lastAlert[$i]=='Francisco')&&($lastAlert[$i+1]=='Int\'l')){
			$lastAlert[$i-1] = $lastAlert[$i-1]." ".$lastAlert[$i]." ".$lastAlert[$i+1]." ".$lastAlert[$2];
			unset($lastAlert[$i]);
			unset($lastAlert[$i+1]);
			unset($lastAlert[$i+2]);
			}
	}*/
	?>