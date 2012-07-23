<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
		<meta property="og:type" content="website" />
		<meta property="fb:admins" content="530768509" />

		<title>Steam Randomizer</title>

		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 
		<link href="global.css" rel="stylesheet" type="text/css" /> 
		<link href="fatalerror.css" rel="stylesheet" type="text/css" /> 
		<link href="header.css" rel="stylesheet" type="text/css" />
		<link href="styles_gamev5.css" rel="stylesheet" type="text/css" />

		<style type="text/css" media="screen"> 
			DIV#loader {
				width: 616px;
				height: 426px;
			}

			DIV#loader.loading {
				background: url(loading.gif) no-repeat center center;
			}
		</style> 
		
		<script type="text/javascript" src="http://steamcommunity.com/public/javascript/prototype-1.6.0.2.js?v=1535683511&l=english"></script> 
		<script type="text/javascript" src="http://steamcommunity.com/public/javascript/scriptaculous/scriptaculous.js?v=2361208777&l=english&load=effects,controls,slider,dragdrop"></script> 
		<script type="text/javascript" src="http://steamcommunity.com/public/javascript/global.js?v=3661003391&l=english"></script>
		<script type="text/javascript" src="http://www.harrymaugans.com/wp-content/uploads/2007/03/motionpack1.js"> </script>
		<script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
		<script> 

			var gameid;
			var gamename;
			var imgurl;
			
			var toggle = 0;
			var toggleid = 0;


			var $jquery = jQuery.noConflict();
			
			function counter(){
			
				new Ajax.Request("counter.php",{});
			}

			function playnow_db(){
			
				new Ajax.Request("playnow_db.php",{});
			}
			
			function parseRsp(str){
				rspArray = str.split(",,,");

				gameid = rspArray[0];
				gamename = rspArray[1];
				imgurl = rspArray[2];
			}

			function sendRequest() {

				//hides placeholder image
				document.getElementById('phimg').style.display = "none";

				//shows loading gif
				document.getElementById('loader').style.display = "block";

				//hide game image, play now bar and share slider
				document.getElementById('gameimg').style.display = "none";
				document.getElementById('bar').style.display = "none";
				document.getElementById('sharediv').style.display = "none";


				new Ajax.Request("steam.php", 
					{ 
					method: 'post', 
					postBody: 'steamid='+ $F('steamid'),
					onComplete: showResponse 
					});
			}

			function switch_load(){

				document.getElementById('loader').style.display = "none";
				document.getElementById('gameimg').style.display = "block";
				document.getElementById('bar').style.display = "block";

			}
		
			function loadjs(filename){

				var head = document.getElementsByTagName('head')[0];
 
				var fileref=document.createElement('script')
				fileref.type = 'text/javascript';
				fileref.src = filename;

				if (typeof fileref!="undefined")
					head.appendChild(fileref)

				return head;
			}

			// Popup window code
			function fbPopup() {
				
				var  url = 'http://www.facebook.com/dialog/feed?'+
								'app_id=198221376871982&'+
								'link=http://web.ist.utl.pt/ist156960/&'+
								'picture=http://fbrell.com/f8.jpg&'+
								'name=Facebook%20Dialogs&'+
								'caption=Reference%20Documentation&'+
								'description=Dialogs%20provide%20a%20simple,%20consistent%20interface%20for%20applications%20to%20interact%20with%20users.&'+
								'message=Facebook%20Dialogs%20are%20so%20easy!&'+
								'display=popup&'+
								'redirect_uri=http://web.ist.utl.pt/ist156960/selfclose.html';
			
				popupWindow = window.open(
					url,
					'popUpWindow',
					'height=400,width=780,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
			}

			function toggleShare(){

				var headtwitter;
				var headbuzz;

				if (toggle == 0) {

					if (gameid != toggleid) {

						toggleid = gameid;

						var share_html= '<a href="http://twitter.com/share"'+
											' class="twitter-share-button"'+
											' data-text="I just randomed '+ gamename +' at Steam Randomizer! Random your game to at SITE!"'+
											' data-count="horizontal"'+
											' data-via="steamrandomizer"'+
											' data-related="jfloff:Creator of Steam Randomizer">Tweet</a>'+
										'<a href="JavaScript:fbPopup();"><img src="fbshare_button.png" alt="Share on Facebook" />'+
										'<a href="http://www.google.com/buzz/post"'+
											' class="google-buzz-button"'+
											' title="Steam Randomizer"'+
											' data-message="I just randomed GAME at Steam Randomizer! Random your game to at SITE!"'+
											' data-url="http://wweb.ist.utl.pt/ist156960"'+
											' data-locale="en"'+
											' data-button-style="small-count">HELLO</a>';
										
						
						$('sharediv').innerHTML = share_html;

						headtwitter = loadjs('http://platform.twitter.com/widgets.js');
						//headbuzz = loadjs('http://www.google.com/buzz/api/button.js');
					}

					toggle = 1;
				}

				toggleSlide('sharediv');

				head.removeChild(headbuzz);
				head.removeChild(headtwitter)
			}

			function showResponse(req){

				var rsp = req.responseText;
				parseRsp(rsp);
			
				var msg =	'<a href="http://store.steampowered.com/app/'+ gameid +'/"><img src="'+ imgurl +'" width="616" height="354" onload="switch_load();"></a>'; 
				var gbar =	'<div class="game_area_already_owned" style="width: 588px; margin: 0 auto;">'+
								'<div class="already_owned_actions">'+
									'<div class="game_area_already_owned_btn">'+
										'<div class="leftcap"></div>'+
										'<a href="javascript:;" class="content" onmousedown="toggleShare()">Share your Random!</a></p>'+ 
										'<div class="rightcap"></div>'+
									'</div>'+
									'<div class="game_area_already_owned_btn" >'+
										'<div class="leftcap"></div>'+
										'<a class="content" onClick="sendRequest()" href="javascript: void(0)">Random Again!</a>'+
										'<div class="rightcap"></div>'+
									'</div>'+
									'<div class="game_area_already_owned_btn">'+
										'<div class="leftcap"></div>'+
										'<a class="content" href="steam://run/'+ gameid +'">Play Now</a>'+ 
										'<div class="rightcap"></div>'+
									'</div>'+
								'</div>'+
							'</div>';

				$('bar').innerHTML = gbar;
				$('gameimg').innerHTML = msg;
			}

			// Popup window code
			function newPopup(url) {
				popupWindow = window.open(
					url,
					'popUpWindow',
					'height=700,width=1100,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
			}

		</script>
		<!-- Share platforms scripts -->
		<script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
		<!-- <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> -->
		</head> 
	<body onload="counter();"> 
		<center> 
			<div id="global_header"> 
				<div class="content"> 
					<div style="position: relative; left: -25px;" class="logo"> 
						<span id="logo_holder"> 
							<a href="http://store.steampowered.com/"> 
								<img src="logo_header.png" border="0" /> 
							</a>
						</span> 
					</div> 
				</div> 
			</div> 
			<div id="userControls" style="position: relative; left: -10px;" >
				<div id="BG_top" style="text-align: center;"> 
					<h2 style="position: relative; top:-10px;">What game will I play today? Just roll the dice.</h2>
					<h3> <form style="position: relative; top:2px;" id="test" onsubmit="return false;"> 
						Steam ID: <input style="text-align:center;" type="text" name="steamid" id="steamid" > 
						<input type="submit" value="Random it!" onClick="sendRequest()"> 
					</form> </h3>
				</div>
				<div id="BG_bottom" style="text-align: center;">
					<br />
					<h1>You will play ...</h1><br />
					<!-- Placeholder Image -->
					<img id="phimg" src="ph_random.png" width="616" height="437">
					<!-- loading gif -->
					<div id="loader" class="loading" style="width: 70%; margin: 0 auto; display: none;"> 
						
					</div>
					<div id="gameimg" style="width: 70%; margin: 0 auto; display: none;"> </div>
					<br clear="all" />
					<!-- GREEN BAR -->
					<div id="bar" style="display: none;"> </div>
					<div id="sharediv" class="game_area_already_owned" style="display:none; height: 35px; width: 588px; margin: 0 auto;">
						<a href="http://www.google.com/buzz/post"
							class="google-buzz-button"
							title="Steam Randomizer"
							data-message="I just randomed GAME at Steam Randomizer! Random your game to at SITE!"
							data-url="http://wweb.ist.utl.pt/ist156960"
							data-locale="en"
							data-button-style="small-count"></a>
					</div>
					<br /> <br />
				</div> 
				<!-- this is just a way to simulate a delay (the script will sleep for 2 seconds then response) -->
				<script src="index.php?action=delay" type="text/javascript" charset="utf-8"></script> 
				<!-- footer --> 
				<div id="footer"> 
					<div id="footerText" style="left: -30px;"> 
						<p>Site by <a href="mailto:steamrandomizer@gmail.com">Yeda</a>. All rights reserved to &copy; Valve Corporation. All trademarks are property of their respective owners in the US and other countries.</p>
					</div>
					<div id="footerSocial">
						<a style="position: relative; top: -1px; right: -10px;" href="JavaScript:newPopup('http://www.twitter.com/steamrandomizer');"><img src="twitter-follow.png" alt="Follow steamrandomizer on Twitter"/></a>
						<iframe style="border:none; overflow:hidden; width:450px; height:21px; position: relative; right: -20px;" 
								src="http://www.facebook.com/plugins/like.php?locale=en_US&href=http%3A%2F%2Fexample.com%2Fpage%2Fto%2Flike&amp;layout=button_count&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;height=50" 
								scrolling="no" frameborder="0" allowTransparency="true" ></iframe>
					</div>
				</div> 
			</div> 
		</center>
	</body>
</html> 
