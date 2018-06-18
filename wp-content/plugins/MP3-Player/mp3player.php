<?php
/*
Plugin Name: MP3 Player plugin
Plugin URI: http://www.thomasnorberg.com/sitemap/mp3-player-plugin-for-wordpress/
Description: <strong>Player has to be configured first.... go to: </strong><a href="options-general.php?page=mp3options" title="MP3 Player Options">Options configuration panel</a>. Adds the option of a custom mp3 player for your sidebar, posts or pages from Premiumbeat.com.  Use the function <code>&lt;?php mp3_embed() ?&gt;</code> to display mp3 player in a different template location. Also refer to <a href="http://www.thomasnorberg.com/plugins-used/test-mp3-player/">MP3 Post/Page embed</a> for further options. <strong>NOTE: When upgrading automatically please make sure to have a back-up of your mp3 folder!</strong>.
Version: 1.2.4
Author: Thomas Norberg
Author URI: http://www.thomasnorberg.com/contact-me/
Plugin Image: http://www.thomasnorberg.com/playerplugin.png 
*/
     $mp3_player_version = '1.2.4';
/*
== Installation ==
 
1. Upload the whole plugin folder mp3player.zip to the /wp-content/plugins/ directory
2. Activate the plugin through the 'Plugins' menu in WordPress by clicking "MP3 Player plugin"
3. Go to your Options Panel and open the "MP3 options" submenu. /wp-admin/options-general.php?page=mp3options
4. Go to widgets submenu under Appearance Panel and activate widget title "MP3 Player plugin". /wp-admin/widgets.php 
5. You can also activate it anywhere in your wordpress site by adding &lt;?php mp3_embed() ?&gt;
6. You can also add a RSS link to those .mp3 files anywhere in your wordpress site by adding &lt;?php RSS_embed(); ?&lt;
7. Only .mp3 files work with this plugin. (upload files to /wp-content/plugins/mp3&#95;player&#95;options/mp3 ) 
8. Note: if updating to new version move mp3 folder to different location so not to lose all your songs in the folder.
*/
 
/*
 Copyright 2009 Thomas Norberg  (email : Tnorberg@thomasnorberg.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or


    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

global $wp_version, $mp3_player_plugin_url, $mp3_player_version, $optionset;

$mp3_player_plugin_url = trailingslashit( WP_PLUGIN_URL.'/'.dirname( plugin_basename(__FILE__) ));

$exit_msg='MP3 Player Plugin requires WordPress 2.5 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';

if (version_compare($wp_version,"2.5","<"))
 {
   exit ($exit_msg);
 }

/****************************
   Render update info on the plugins panel if the update is available.
****************************/
        function mp3_plugin_check_version($file, $plugin_data) {
            global $wp_version;
            static $this_plugin;
            $wp_version = str_replace(".","",$wp_version);
            if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

            if ($file == $this_plugin){
                $current = $wp_version < 28 ? get_option('update_plugins') : get_transient('update_plugins');
                if (!isset($current->response[$file])) return false;

                $columns =  $wp_version < 28 ? 5 : 3;
                $url = 'http://www.thomasnorberg.com/pluginversions.txt';
                $update = wp_remote_fopen($url);
                if ($update != "") {
                    echo '<tr class="plugin-update-tr"><td colspan="'.$columns.'" class="plugin-update"><div class="update-message">';
                    echo $update;
                    echo '</div></td></tr>';
                }
            }
        }
add_action('after_plugin_row', 'mp3_plugin_check_version', 10, 2);

/****************************
   Adds Plugin links to the first part of plugin in plugins panel.
****************************/
function add_plugin_links($links, $file) {
	
	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

		if ($file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=mp3options" title="MP3 Player Settings">' . __('Settings') . '</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
}

add_filter('plugin_action_links', 'add_plugin_links', 10, 2);

/****************************
   Adds Plugin links under the description of the plugin in plugins panel.
****************************/
function add_meta_links($links, $file) {

	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

		if ($file == $this_plugin ){		
			$links[] = '<a href="options-general.php?page=mp3options" title="MP3 Player Settings">' . __('Settings') . '</a>';
			$links[] = '<a href="http://www.thomasnorberg.com/plugins-used/mp3-player-plugin-for-wordpress-forum/" title="MP3 Player Forum">' . __('Forum') . '</a>';
			$links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6149599" title="Donate Please">' . __('Donate') . '</a>';
                        $links[] = '<a href="http://www.thomasnorberg.com/plugins-used/mp3-player-plugin-for-wordpress-forum/showcase-your-site-here/" title="Showcase Your Site">' . __('Showcase Your Site!') . '</a>';
		}
		return $links;
	}
add_filter('plugin_row_meta', 'add_meta_links', 10, 2);


/****************************
   Initialize the options for the admin page.
****************************/
$optionset = array(
		'folder' => 'mp3',
		'ss_mp3' => 'thisIsWar.mp3',
                'mp3_aligner' => 'left',
                'RSS_title' => 'Your Title',
                'mp3_height3' => '250',     
                'mp3_height2' => '95',   
                'mp3_height1' => '30',            
                'mp3_width3' => '200',
                'mp3_width2' => '195',
                'mp3_width1' => '73',
                'mp3_google_high' => '28',
                'mp3_google_wid' => '300',
                'ply_op' => '2',
                'grrblog' => 'Catchy title for RSS',
                'blog_name' => 'Name of Your Blog here',
                'RSS_email' => 'your_email@your_domain.com',
                'mp3_RSS' => 'no',
                'hexBox' => '#408080',
                'mp3_num1' => '5',
                'mp3_num2' => '5',
                'mp3_num3' => '5',
                'mp3_ap' => 'no',  
                'shuff' => 'no',
                'transp' => 'yes',
                'number' => 'yes',
                'pop_mp3' => 'no'
                   );

function mp3_Init()
 {
   // register widget
   register_sidebar_widget('MP3 Player plugin', 'mp3_player_widget');

   // register widget control
   register_widget_control('MP3 Player plugin', 'mp3_player_WidgetControl');
 }
add_action('init', 'mp3_Init');
 
/****************************
   Required for wordpress 2.7 or higher
****************************/
function mp3_mu_settings(){
        register_setting('mp3options', 'shuff');
        register_setting('mp3options', 'folder'); 
        register_setting('mp3options', 'ss_mp3'); 
        register_setting('mp3options', 'mp3_aligner');
        register_setting('mp3options', 'RSS_title');
        register_setting('mp3options', 'mp3_height');
        register_setting('mp3options', 'mp3_width');
        register_setting('mp3options', 'ply_op'); 
        register_setting('mp3options', 'grrblog');
        register_setting('mp3options', 'blog_name'); 
        register_setting('mp3options', 'RSS_email');  
        register_setting('mp3options', 'mp3_RSS');  
        register_setting('mp3options', 'picker');  
        register_setting('mp3options', 'hexBox');  
        register_setting('mp3options', 'mp3_num1');  
        register_setting('mp3options', 'mp3_num2');   
        register_setting('mp3options', 'mp3_num3'); 
        register_setting('mp3options', 'mp3_ap');  
        register_setting('mp3options', 'transp');  
        register_setting('mp3options', 'number');
        register_setting('mp3options', 'pop_mp3');   
}
add_action('admin_init', 'mp3_mu_settings' );


/****************************
   Initialize our Base64 Icons 
****************************/
function GetBase64IconURL_mp3_player($resourceID) {
		return '?mp3resource=' . $resourceID;
	}
function IniBase64Icons_mp3_player() {
include($mp3_player_plugin_url.'Iconmaker.php');
	} 
add_action('init', 'IniBase64Icons_mp3_player' ); 


function mp3_player_WidgetControl()
 {
   // get saved options
   $options = get_option('mp3_play');
   // handle user input
   if ( $_POST["mp3_submit"] )
     {
     $options['mp3_title'] = strip_tags( stripslashes($_POST["mp3_title"] ) );
     update_option('mp3_play', $options);
     }
   $title = $options['mp3_title'];
   // print out the widget control
   ?><p>
<label for="mp3_title">Title: <input name="mp3_title" type="text" value="<?php echo $title; ?>" /></label>
<input type="hidden" id="mp3_submit" name="mp3_submit" value="1" />
</p><?php 
 }

function mp3_admin_page() 
 { // Add a new submenu under Options:
   add_options_page('MP3 Player Options', 'MP3 Player Options', 8, 'mp3options', 'mp3_options_page');
 }
   // Hook for adding admin menus
add_action('admin_menu', 'mp3_admin_page');
 
/****************************
   mp3_player($atts) adds the ability to use shortcode [mp3_embed].
****************************/
function mp3_player($atts) 
 { global $mp3_player_version, $mp3_player_plugin_url;
   include('shortcode_mp3.php');
if ($error) { include_once('css/error.php');
       $error .= '</p></div>';
       return $error; }
if( $blog_plyrs == '4')
   { $blog_plyrs = "http://www.google.com/reader/ui/3247397568-audio-player.swf";
     $plyr = "googlemp3player";
     if ($mp3highs == '30')
      $mp3highs = '28';
     if ($mp3wids == '73')
       $mp3wids = '450';

        $mp3_player_popup = '<!-- Begin MP3 Player for Wordpress Version "' . $mp3_player_version . '"-->
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
if($pop_mp3 == 'yes')
 { $mp3_player_popup .= '<input class="htmlselectcode" type="button" value="Open Window" onclick="open_win(\'' . $mp3_player_version . '\',\'' . $mp3_aligns . '\',\'' . $plyr . '\',\'' . $transparent . '\',\'' . $id . '\',\''  . $blog_plyrs . '\',\'' . $mp3wids . '\',\'' . $mp3highs . '\',\'' . $aps . '\',\'' . $sound . '\',\'' . rawurlencode($playlst) . '\',\'' . rawurlencode($playlistfolder) . '\',\'' . $shuffle . '\',\'' . rawurlencode($colors) . '\',\'' . $nums . '\',\'' . $mp3_player_plugin_url . '\', \'1\')"/>';
 }
   }else{ 
$mp3_player_popup = '<!-- Begin MP3 Player for Wordpress Version "' . $mp3_player_version . '"-->
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
if($pop_mp3 == 'yes')
 { $mp3_player_popup .= '<input class="htmlselectcode" type="button" value="Open Window" onclick="open_win(\'' . $mp3_player_version . '\',\'' . $mp3_aligns . '\',\'' . $plyr . '\',\'' . $transparent . '\',\'' . $id . '\',\''  . $blog_plyrs . '\',\'' . $mp3wids . '\',\'' . $mp3highs . '\',\'' . $aps . '\',\'' . $sound . '\',\'' . rawurlencode($playlst) . '\',\'' . rawurlencode($playlistfolder) . '\',\'' . $shuffle . '\',\'' . rawurlencode($colors) . '\',\'' . $nums . '\',\'' . $mp3_player_plugin_url . '\', \'2\')"/>';
 }
       }
     return $mp3_player_popup;                                                   
   }
add_shortcode('mp3_embed', 'mp3_player');   

/****************************
   pop_window_mp3() adds the ability to have a popup come up when button is pressed under player. 
****************************/
function pop_window_mp3()
   { ?>
     <script type="text/javascript">
     /* <![CDATA[ */
     function open_win(mp3_player_version, mp3_align, plyrs, transparent, id, blog_plyrs,  mp3wid, mp3high, aps, sound, playlst, playlistfolder, shuffle, colors, nums, mp3_player_plugin_url, which)
       {  
        window.open(mp3_player_plugin_url+ 'pop_up_mp.php?a=' +mp3_player_version+ '&b=' +mp3_align+ '&c=' +plyrs+ '&d=' +id+ '&e=' +transparent+ '&f=' +blog_plyrs+ '&g=' +mp3wid+ '&h=' +mp3high+ '&i=' +aps+ '&j=' +sound+ '&k=' +playlst+ '&l=' +playlistfolder+ '&m=' +shuffle+ '&n=' +colors+ '&o=' +nums+ '&p=' +mp3_player_plugin_url+ '&q=' +which, '_blank', 'statusbar=no, titlebar=no, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=no, width='+mp3wid+', height='+mp3high); 
        }
        /* ]]> */
        </script><?php  
   }
   add_action( 'wp_head', 'pop_window_mp3' );

/****************************
   mp3_embed() adds the ability to use php mp3_embed();  to display mp3 player. 
****************************/
function mp3_embed()
 {  
   include('mp3-play-widget.php');
 }

/****************************
   mp3_player_widget($args = array()) adds options for widget and embed mp3 player. 
****************************/   
function mp3_player_widget($args = array())
 { // extract the parameters
   global $mp3_player_version, $optionset, $getid;
   extract($args);

   // get our options
   $options = get_option('mp3_play');
   $title = $options['mp3_title'];

   // print the theme compatibility code
   echo $before_widget;
   echo $before_title . $title. $after_title;

   // include our widget
   include('mp3-play-widget.php');
   echo $after_widget;
 }

/****************************
    check_valid_colorhex($hex_num) checks to see if the html color is correct 
****************************/ 
function check_valid_colorhex($hex_num) 
 {
   // If user accidentally passed along the # sign, strip it off
   $hex_num = ltrim($hex_num, '#');
                                      
   if ( ctype_xdigit($hex_num) && (strlen($hex_num) == 6 || strlen($hex_num) == 3))
               return true;

   else return false;
 }

/****************************
    mp3_options_page() displays the admin options
****************************/ 
function mp3_options_page() 
 {  
   global $mp3_player_version;
   // variables for the field and option names
   include('admin_options_mp3_page.php');
   //end of function mp3_options_page() 
 }
?>