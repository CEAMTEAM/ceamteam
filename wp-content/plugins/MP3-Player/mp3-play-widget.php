<?php 
//TITLE: mp3-play-widget.php 
//This brings in the mp3 player url 
global $mp3_player_plugin_url, $mp3_player_version;

(get_option('hexBox') ? $culor = get_option('hexBox') : $culor = $optionset['hexBox']);
(get_option('mp3_ap') ? $ap = get_option('mp3_ap') : $ap = $optionset['mp3_ap']);
(get_option('ply_op') ? $blog_plyr = get_option('ply_op') : $blog_plyr = $optionset['ply_op']);
(get_option('mp3_aligner') ? $mp3_align = get_option('mp3_aligner') : $mp3_align = $optionset['mp3_aligner']);
(get_option('folder') ? $fldr = get_option('folder') : $fldr = $optionset['folder']);
(get_option('shuff') ? $shuffle = get_option('shuff') : $shuffle = $optionset['shuff']);
(get_option('transp') ? $transpa = get_option('transp') : $transpa = $optionset['transp']); 
(get_option('number') ? $numrr = get_option('number') : $numrr = $optionset['number']);     
(get_option('pop_mp3') ? $popmp3 = get_option('pop_mp3') : $popmp3 = $optionset['pop_mp3']);
if($transpa == 'yes')
   { $transpa = 'transparent';
   }
function embed_RSS()
   {  
     global $mp3_player_plugin_url;
     $rssttl = get_option('RSS_title');
     $rss = get_option('mp3_RSS');
     $email = get_option('RSS_email');
     $blogname = get_option('blog_name');
     $blogdes = get_option('grrblog');
     $fldr = get_option('folder');

     if ( $rss == 'yes') 
          { ?><p><a class="rss" href="<?php echo $mp3_player_plugin_url . "playlist22.php?eml=" . $email . "&#38;blgnme=" . $blogname . "&#38;dircrip=" . $blogdes . "&#38;folder=" . $fldr; ?>"><?php echo $rssttl; ?></a></p><?php }
   }

if( $blog_plyr == '1')
   { $blog_plyr = $mp3_player_plugin_url . 'player_options/playerMini.swf'; 
     $plyrs = 'playerMini';
     $sounds = 'soundPath'; 
     $mp3_filer = get_option('ss_mp3');
     $mp3files = $mp3_player_plugin_url . 'mp3/' . $mp3_filer;
     (get_option('mp3_num1') ? $num1 = get_option('mp3_num1') : $num1 = $optionset['mp3_num1']);
     (get_option('mp3_height') ? $mp3high = get_option('mp3_height') : $mp3high = $optionset['mp3_height1']);
     (get_option('mp3_width') ? $mp3wid = get_option('mp3_width') : $mp3wid = $optionset['mp3_width1']);
     $num = $num1;
   }

if( $blog_plyr == '2')
   { $blog_plyr = $mp3_player_plugin_url . 'player_options/playerMultiple.swf'; 
     $plyrs = 'playerMultiple';
     $sounds = 'playlistPath';
     (get_option('mp3_num2') ? $num2 = get_option('mp3_num2') : $num2 = $optionset['mp3_num2']);
     (get_option('mp3_height') ? $mp3high = get_option('mp3_height') : $mp3high = $optionset['mp3_height2']);
     (get_option('mp3_width') ? $mp3wid = get_option('mp3_width') : $mp3wid = $optionset['mp3_width2']);
     $num = $num2;
             if($numrr == 'yes')
              { $mp3files = $mp3_player_plugin_url . 'playlist.php';
              }
            else
              { $mp3files = $mp3_player_plugin_url . 'playlist1.php';
              } 
   }
if( $blog_plyr == '3')
   { $blog_plyr = $mp3_player_plugin_url . 'player_options/playerMultipleList.swf'; 
     $plyrs = 'playerMultipleList'; 
     $sounds = 'playlistPath';
     (get_option('mp3_num3') ? $num3 = get_option('mp3_num3') : $num3 = $optionset['mp3_num3']);
     (get_option('mp3_height') ? $mp3high = get_option('mp3_height') : $mp3high = $optionset['mp3_height3']);
     (get_option('mp3_width') ? $mp3wid = get_option('mp3_width') : $mp3wid = $optionset['mp3_width3']);
     $num = $num3;
             if($numrr == 'yes')
              { $mp3files = $mp3_player_plugin_url . 'playlist.php';
              }
            else
              { $mp3files = $mp3_player_plugin_url . 'playlist1.php';
              } 
   }   
    if($num == '6'){
        $blog_plyr = "http://www.google.com/reader/ui/3247397568-audio-player.swf";
        $plyrs = 'googlemp3player'; 
        (get_option('mp3_height') ? $mp3high = get_option('mp3_height') : $mp3high = $optionset['mp3_google_high']);
        (get_option('mp3_width') ? $mp3wid = get_option('mp3_width') : $mp3wid = $optionset['mp3_google_wid']);
            if($popmp3 == 'yes')
              { echo '<input class="htmlselectcode" type="button" value="Open Window" onclick="open_win(\'' . $mp3_player_version . '\',\'' . $mp3_align . '\',\'' . $plyrs . '\',\'' . $transpa . '\',\'' . $id . '\',\''  . $blog_plyr . '\',\'' . $mp3wid . '\',\'' . $mp3high . '\',\'' . $ap . '\',\'' . $sounds . '\',\'' . $mp3files . '\',\'' . $fldr . '\',\'' . $shuffle . '\',\'' . rawurlencode($culor) . '\',\'' . $num . '\',\'' . $mp3_player_plugin_url . '\', \'1\')"/>';
              }
        echo '<!-- Begin MP3 Player for Wordpress Version "' . $mp3_player_version . '"-->
          <div align="' . $mp3_align . '" id="' . $plyrs . $id . '">
           <object width="' . $mp3wid . '" height="' . $mp3high . '" data="' . $blog_plyrs . '?audioUrl=' . $mp3files . '" type="application/x-shockwave-flash">
            <param name="bgcolor" value="' . $culor.'" />
            <param name="flashvars" value="playerMode=embedded" />
            <param name="src" value="' . $blog_plyr . '?audioUrl=' . $mp3files . '" />
            '; if ($transpa == 'transparent'){ echo '
            <param name="wmode" value="' . $transpa .'" />'; } 
            echo '<param name="quality" value="best" />
           </object>
          </div>
               <!-- End MP3 Player for Wordpress Version "' . $mp3_player_version . '"-->';

          }  
    else  {   
            if($popmp3 == 'yes')
              { echo '<input class="htmlselectcode" type="button" value="Open Window" onclick="open_win(\'' . $mp3_player_version . '\',\'' . $mp3_align . '\',\'' . $plyrs . '\',\'' . $transpa . '\',\'' . $id . '\',\''  . $blog_plyr . '\',\'' . $mp3wid . '\',\'' . $mp3high . '\',\'' . $ap . '\',\'' . $sounds . '\',\'' . rawurlencode($mp3files) . '\',\'' . rawurlencode($fldr) . '\',\'' . $shuffle . '\',\'' . rawurlencode($culor) . '\',\'' . $num . '\',\'' . $mp3_player_plugin_url . '\', \'2\')"/>';
              }
    
    echo '<!-- Begin MP3 Player for Wordpress Version "' . $mp3_player_version . '"-->
    <div id="' . $plyrs . '" align="' . $mp3_align . '">' . embed_RSS() . '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab" width="' . $mp3wid . '" height="' . $mp3high .'">
             <param name="movie" value="' . $blog_plyr . '" />
         '; if ($transpa == 'transparent'){ echo '
             <param name="wmode" value="' . $transpa .'" />'; }
            echo '
             <param name="FlashVars" value="autoPlay=' . $ap . '&amp;' . $sounds . '=' . $mp3files . '?var1=' . $fldr . '/' . $shuffle . '&amp;overColor=' . $culor . '&amp;playerSkin=' . $num . '" />
          <!--[if !IE]> <-->
             <script type="text/javascript" src="' . $mp3_player_plugin_url . 'swfobject.js"></script>
               <div id="mp3playerpluginforwordpress">
                <img src="' . $mp3_player_plugin_url . 'img/noflash.gif" alt="Flash required" />
               </div>

             <script type="text/javascript">
                 var so = new SWFObject("' . $blog_plyr . '", "mymovie", "' . $mp3wid . '", "' . $mp3high . '", "7", "#FFFFFF"); ' ;
                 if ($transpa == 'transparent'){ echo '
                   so.addParam("wmode", "' . $transpa .'")'; }
                 echo '
                   so.addVariable("autoPlay","' . $ap . '")
                   so.addVariable("playerSkin","' . $num . '")
                   so.addVariable("overColor","' . $culor . '")
                   so.addVariable("' . $sounds . '","' . $mp3files . '?var1=' . $fldr . '/' .  $shuffle . '")                 
                   so.write("mp3playerpluginforwordpress");
             </script>  		

          <!--> <![endif]-->
</object>
      </div>
<!-- MP3 Player Plugin For Wordpress End Version "' . $mp3_player_version . '"-->'; 

}

?>