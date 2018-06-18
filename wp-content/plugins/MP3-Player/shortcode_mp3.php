<?php 
//TITLE: shortcode_mp3.php
//This brings in the mp3 player url 
global $mp3_player_plugin_url;
extract(shortcode_atts(array(
		'mp3_aligns' => 'left',
		'aps' => 'no',
                'colors' => '#1FBF26',
                'nums' => '3',
                'mp3wids' => '73',
                'mp3highs' => '30',
                'blog_plyrs' => '1',
                'playlst' => $mp3_player_plugin_url . 'playlist.php',
                'id' => '1',
                'playlistfolder' => 'mp3',
                'shuffle' => 'no',
                'transparent' => 'yes',
                'show' => 'yes',
                'pop_mp3' => 'no'   
	), $atts));

if(function_exists('check_valid_colorhex'))
   {  $error = '';
      if( check_valid_colorhex($colors) == false || $blog_plyrs< '1' || $blog_plyrs > '4') 
     { $i=0;
          $error .= "<div class='plugin'><p class='error'><strong>YOU HAVE MADE THE FOLLOWING ERRORS!!!!</strong><br />";
          if(check_valid_colorhex($colors) == false )
           { $i++;
             $error .= $i.") You have entered an invalid HEX Color Code \"<strong>" . $colors . "</strong>\" please read the directions!<br />"; 
           } 
          if( $blog_plyrs< '1' || $blog_plyrs > '4') 
           { $i++;
             $error .= $i.") This is not a valid blog player \"<strong>".$blog_plyrs."</strong>\". Please Enter the correct blog_plyrs id (1,2,3,or 4)! <br />";
           }  
     }
}

if($transparent == 'yes')
   { $transparent = 'transparent';
   }
else if($transparent == 'no')
   { $transparent = '';
   }
if( $blog_plyrs == '1')
   { $blog_plyrs = $mp3_player_plugin_url . "player_options/playerMini.swf"; 
     $plyr = 'playerMini';
     $sound = 'soundPath'; 
   }
if( $blog_plyrs == '2')
   { $blog_plyrs = $mp3_player_plugin_url . "player_options/playerMultiple.swf"; 
     $plyr = 'playerMultiple';
     $sound = 'playlistPath';
     if ($mp3highs == '30')
      $mp3highs = '100';
     if ($mp3wids == '73')
     $mp3wids = '195';
     if($show == 'yes')
      { $playlst = $mp3_player_plugin_url . 'playlist.php';
      }
     else if($show == 'no') 
      { $playlst = $mp3_player_plugin_url . 'playlist1.php';
      }
   }
if( $blog_plyrs == '3')
   { $blog_plyrs = $mp3_player_plugin_url . "player_options/playerMultipleList.swf"; 
     $plyr = 'playerMultipleList'; 
     $sound = 'playlistPath';
     if ($mp3highs == '30')
      $mp3highs = '250';
     if ($mp3wids == '73')
       $mp3wids = '200';
     if($show == 'yes')
      { $playlst = $mp3_player_plugin_url . 'playlist.php';
      }
     else if($show == 'no') 
      { $playlst = $mp3_player_plugin_url . 'playlist1.php';
      }
   }    
?>