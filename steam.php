<?php

	function update_db($id){

		$con = mysql_connect("db.ist.utl.pt","ist156960","ljst1169");

		mysql_select_db("ist156960", $con);
		
		$query = sprintf("SELECT numrand FROM Random WHERE gameid='$id'");

		$result = mysql_query($query);
		
		//if gameid is already on the db
		if ( mysql_num_rows($result) != 0 ){
		
			//get numrand already there and increment
			while ($row = mysql_fetch_assoc($result)) {
				$numrand = $row['numrand'];
			}
			$numrand++;
			
			//update database
			mysql_query("UPDATE Random SET numrand = '$numrand' WHERE gameid = '$id'");
		}
		else {
			mysql_query("INSERT INTO Random (gameid, numrand) VALUES ('$id', '1')");
		}

		mysql_close($con);
	}

	function random_game($id){

		//steam community link
		if (is_numeric ($id)) {
			//if yes then id is profileid, uses this type of link
			$url = "http://steamcommunity.com/profiles/{$id}/games?tab=all";
		} else {
			//if no then id is username, uses this type of link
			$url = "http://steamcommunity.com/id/{$id}/games?tab=all";
		}

		//get url data and separates code by '\n'
		$string_url = file_get_contents($url);

		//check if the Steam ID exists
		$error_url = $string_url;
		$error = preg_match("/<title>Steam Community :: Error<\/title>/", $error_url, $matches);
		if ($error == 1) return false;

		$array_string_url = explode("\n",$string_url);

		//get rgGame existant
		//example --> rgGames['24420'] = 'Aquaria';
		$rgGames_array = preg_grep('/rgGames\[\'[0-9]+\'\] = \'(.*)\';/', $array_string_url); 

		//get array of game names
		$index = 0;
		foreach ($rgGames_array as $i => $value) {
			$name_bool = preg_match("/rgGames\[\'[0-9]+\'\] = \'(.*)\';/", $rgGames_array[$i], $matches);
			if ($name_bool = true) {
				$game_names[$index] =  $matches['1'];
				$index++;
			} 
		}

		//get array of game ids
		$index = 0;
		foreach ($rgGames_array as $i => $value) {
			$do = preg_match("/rgGames\[\'(.*)\'\] = \'(.*)\';/", $rgGames_array[$i], $matches);
			if ($do = true) {
				$game_ids[$index] =  $matches['1'];
				$index++;
			}
		}

		//random the game
		$rand_index = rand (0 , $index - 1);
		$theone_name = $game_names[$rand_index];
		$theone_id = $game_ids[$rand_index];

		$theone = array(0 => $theone_id, 1 => $theone_name);

		return $theone;
	}

	$steamid = $_POST["steamid"];

	if($_POST["steamid"] != ""){
		$game = random_game($steamid);

		if ($game == false){
			print false;
		} else {

			$gameid = $game[0];
			$gamename = $game[1];
			
			update_db($gameid);

			$comma = ",,,";

			if (@file_get_contents("http://cdn.steampowered.com/v/gfx/apps/$gameid/capsule_616x353.jpg") == false) {
				$imgurl = "http://cdn.steampowered.com/v/gfx/apps/$gameid/header_292x136.jpg";
			} else {
				$imgurl = "http://cdn.steampowered.com/v/gfx/apps/$gameid/capsule_616x353.jpg";
			}

			print $gameid;
			print $comma;
			print $gamename;
			print $comma;
			print $imgurl;
		}
	}
?>