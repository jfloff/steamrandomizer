(function(){
	var screen_name = escape( 
				(typeof tweetmeme_screen_name=="string") ? tweetmeme_screen_name: ((typeof TWEETMEME_SCREEN_NAME=="string")?TWEETMEME_SCREEN_NAME:false));
	var style = (typeof tweetmeme_style=="string")?escape(tweetmeme_style):((typeof TWEETMEME_STYLE=="string")?escape(TWEETMEME_STYLE):"normal");
	var size = 	(typeof tweetmeme_size=="string")?escape(tweetmeme_size):((typeof TWEETMEME_SIZE=="string")?escape(TWEETMEME_SIZE):false);
	if(screen_name){
		var src="http://api.tweetmeme.com/v2/follow.js";
		switch(style){
			case"compact":var h=21;var w=85;break;
			case"square":var h=size;var w=size;break;
			default:var h=20;var w=85;break
		}
		src+="?screen_name="+screen_name;
		src+="&style="+style;
		document.write('<iframe src="'+src+'" height="'+h+'" width="'+w+'" frameborder="0" scrolling="no"></iframe>')
	}
	tweetmeme_screen_name=null;
	TWEETMEME_SCREEN_NAME=null;
	tweetmeme_style=null;
	TWEETMEME_STYLE=null
})();