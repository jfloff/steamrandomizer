<html>
	<head>
		<title>Fileplay Watcher</title>
		
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">
		
			var $jquery = jQuery.noConflict();

  			function input(){
  				var id = prompt("Input the Fileplay Video ID.","");
  				
  				alert(id);
  				
  				document.getElementById('newvid').style.display = "block";
  				
  				var playerhtml = '<object data="http://static.multiplayuk.com/flash/jw5/player-embed-52-skin.swf?4" height="346" id="fileplay-'+ id +'-object" name="fileplay-'+ id +'-object" type="application/x-shockwave-flash" width="614" wmode="transparent">'+
  						'<param name="movie" value="http://static.multiplayuk.com/flash/jw5/player-embed-52-skin.swf?4" />'+
  						'<param name="allowfullscreen" value="true" />'+
  						'<param name="wmode" value="transparent" />'+
  						'<param name="allowscriptaccess" value="always" />'+
  						'<param name="flashvars" value="file_id='+ id +'" />'+
  						'+<div id="getflash" style="width:614px;height:346px">'+
  							'<a href="http://get.adobe.com/flashplayer/" title="Click to Download &amp; install Flash">'+
  								'<img alt="Get Flash" src="http://www.fileplay.net/images/getflash.png" />'+
  							'</a>'+
  						'</div>'+
  					'</object>';
  					
  				$('player').innerHTML = playerhtml;
  				
			}
			
		</script>
	
	</head>
	<body onload="input();">
		
		<div id="player"></div>
		
		<a id="newvid" style="display: none;" onClick="input()" href="javascript: void(0)"> Switch Video </a>

	</body>
</html>