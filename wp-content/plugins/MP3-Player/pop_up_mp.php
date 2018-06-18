<?php 
$mp3_player_version = $_GET['a'];
$mp3_aligns = $_GET['b'];
$plyr = $_GET['c'];
$id = $_GET['d'];
$transparent = $_GET['e'];
$blog_plyrs = $_GET['f'];
$mp3wids = $_GET['g'];
$mp3highs = $_GET['h'];
$aps = $_GET['i'];
$sound = $_GET['j'];
$playlst = $_GET['k'];
$playlistfolder = $_GET['l'];
$shuffle = $_GET['m'];
$colors = $_GET['n'];
$nums = $_GET['o'];
$mp3_player_plugin_url = $_GET['p'];
$which = $_GET[q];
$mp3_player_pop = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
     <head profile="http://gmpg.org/xfn/11">
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title>MP3 Player ' . $plyr . $id . '</title>    
  </head>
 <body>';
if($which == '1'){
$mp3_player_pop .= '<!-- Begin MP3 Player for Wordpress Version "' . $mp3_player_version . '"-->
<div align="' . $mp3_aligns . '" id="' . $plyr . $id . '">
     <object width="' . $mp3wids . '" height="' . $mp3highs . '" data="' . $blog_plyrs . '?audioUrl=' . $playlst . '" type="application/x-shockwave-flash">
<param name="bgcolor" value="' . $colors.'" />
<param name="flashvars" value="playerMode=embedded" />
<param name="src" value="' . $blog_plyrs . '?audioUrl=' . $playlst . '" />
<param name="wmode" value="' . $transparent . '" />
<param name="quality" value="best" />
</object>
</div>
<!-- End MP3 Player for Wordpress Version "' . $mp3_player_version . '"-->';
}
if($which == '2'){
$mp3_player_pop .= '<!-- Begin MP3 Player for Wordpress Version "' . $mp3_player_version . '"-->
<div align="' . $mp3_aligns . '" id="' . $plyr . $id . '">
  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab" width="' .$mp3wids . '" height="' . $mp3highs . '">
    <param name="wmode" value="' . $transparent . '">
    <param name="movie" value="' . $blog_plyrs . '" />
<param name="FlashVars" value="autoPlay=' . $aps . '&amp;' . $sound . '=' . $playlst . '?var1='. $playlistfolder . '/' .  $shuffle . '&amp;overColor=' . $colors.'&amp;playerSkin=' . $nums . '"/>
<!--[if !IE]> <-->
<script type="text/javascript" src="' . $mp3_player_plugin_url . 'swfobject.js"></script>
		
<div id="flashPlayer' . $plyr . $id . '">
<img src="' . $mp3_player_plugin_url . 'img/noflash.gif" alt="Flash required " />
</div>

<script type="text/javascript">
   var so = new SWFObject("' . $blog_plyrs . '", "mymovie", "' . $mp3wids . '", "' . $mp3highs . '", "7", "#FFFFFF");  
   so.addParam("wmode", "' . $transparent . '")
   so.addVariable("autoPlay","' . $aps . '")
   so.addVariable("overColor","' . $colors . '")
   so.addVariable("playerSkin","' . $nums . '")
   so.addVariable("' . $sound . '","' . $playlst . '?var1='. $playlistfolder . '/' .  $shuffle . '")
   so.write("flashPlayer' . $plyr . $id . '");
</script>    
<!--> <![endif]-->
</object></div>

<!-- End MP3 Player for Wordpress Version "' . $mp3_player_version . '"-->';
}
$mp3_player_pop .= '</body>
</html>';
echo $mp3_player_pop;
?>