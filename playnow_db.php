<?php
		$con = mysql_connect("db.ist.utl.pt","ist156960","ljst1169");

		mysql_select_db("ist156960", $con);
		
		$query = sprintf("SELECT numplay FROM Playnow WHERE gameid='$id'");

		$result = mysql_query($query);
		
		//if gameid is already on the db
		if ( mysql_num_rows($result) != 0 ){
		
			//get numrand already there and increment
			while ($row = mysql_fetch_assoc($result)) {
				$numplay = $row['numplay'];
			}
			$numplay++;
			
			//update database
			mysql_query("UPDATE Playnow SET numplay = '$numplay' WHERE gameid = '$id'");
		}
		else {
			mysql_query("INSERT INTO Playnow (gameid, numplay) VALUES ('$id', '1')");
		}

		mysql_close($con);
?>