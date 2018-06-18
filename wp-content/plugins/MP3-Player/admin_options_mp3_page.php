<?php global $mp3_player_plugin_url, $mp3_player_version, $mp3_filer, $optionset; 
?>

<script type="text/javascript">
function showhide_func($option_var, $num_var, $the_layer)
{	var $option_var;
        var $num_var;
        var mylist = document.getElementById($option_var);
	var myLayer = document.getElementById($the_layer).style;
	if(mylist.selectedIndex == $num_var )
		myLayer.display="block";
	else
		myLayer.display="none";
}
</script>
<script type="text/javascript">
    function toggle_visibility(id) { 
       var e = document.getElementById(id);
       if(e.style.display == 'none')
          { e.style.display = 'block'; }
       else
          { e.style.display = 'none'; }
    }
</script>
<script type="text/javascript">
function showplayer(obj,id) {
    var no = obj.options[obj.selectedIndex].value;
    var count = obj.options.length;
   for(i=1;i<=count;i++)
      document.getElementById('player'+id+i).style.display = 'none';
    if(no>0)
      document.getElementById('player'+id+no).style.display = 'block';
}
</script>
<script type="text/javascript">

     function open_win(mp3_player_version, mp3_align, plyrs, transparent, id, blog_plyrs,  mp3wid, mp3high, aps, sound, playlst, playlistfolder, shuffle, colors, nums, mp3_player_plugin_url, which)
       {  
        window.open(mp3_player_plugin_url+ 'pop_up_mp.php?a=' +mp3_player_version+ '&b=' +mp3_align+ '&c=' +plyrs+ '&d=' +id+ '&e=' +transparent+ '&f=' +blog_plyrs+ '&g=' +mp3wid+ '&h=' +mp3high+ '&i=' +aps+ '&j=' +sound+ '&k=' +playlst+ '&l=' +playlistfolder+ '&m=' +shuffle+ '&n=' +colors+ '&o=' +nums+ '&p=' +mp3_player_plugin_url+ '&q=' +which, '_blank', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=no, width='+mp3wid+', height='+mp3high); 
        }

</script>  

   <script src="<?php echo $mp3_player_plugin_url; ?>/colorpicker/javascript.js" type="text/javascript"></script>
<style type="text/css">
			table#outer { width: 100%; border: 0 none; padding:0; margin:0;  }
			table#outer fieldset { border: 0 none; padding:0; margin:0; }
			table#outer td.left, table#outer td.right { vertical-align:top; }
			table#outer td.left {  padding: 0 8px 0 0; }
			table#outer td.right { padding: 0 0 0 8px; width: 210px; }
			td.right ul, td.right ul li { list-style: none; padding:0; margin:0; }
			td.right a { text-decoration:none; background-position:0px 60%; background-repeat:no-repeat; padding: 4px 24px 4px 24px; border: 0 none; display:block;}
			td.right a.lhome { background-image:url(<?php echo GetBase64IconURL_mp3_Player('guide.png'); ?>); }
			td.right a.prbeat { background-image:url(<?php echo GetBase64IconURL_mp3_Player('prbeats.png'); ?>); }
			td.right a.lwp { background-image:url(<?php echo GetBase64IconURL_mp3_Player('wp.png'); ?>); }
      td.right a.chat { background-image:url(<?php echo GetBase64IconURL_mp3_Player('chat.png'); ?>); }  
      td.right a.tools { background-image:url(<?php echo GetBase64IconURL_mp3_Player('wrench.png'); ?>); }
      td.right a.newclass{ text-decoration:none; background-position:0px 60%; background-repeat:no-repeat;  border: 0 none; display:block; padding: 0px 0px 0px 0px;}
			td.right ul li { padding:0; margin:0; text-align: center}
			table#outer td.left dl { background-color: white; border: 1px solid #dfdfdf; }
			table#outer td.right dl { background-color: white; border: 1px solid #636363; }
			table#outer td dl{ -moz-border-radius: 5px; -khtml-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; padding:0; margin: 10px 0 20px 0; }
			table#outer td.left dl h4 { margin:0; padding: 5px 12px 5px 12px; background: #dfdfdf url(<?php echo GetBase64IconURL_mp3_Player('bg-header-gray.png'); ?>) repeat-x left top; font-size: 13px; height: 19px;}
      table#outer td.right dl h4 { color: #FFFFFF; margin:0; padding: 5px 12px 5px 12px; background: #636363 url(../wp-admin/images/fav.png) repeat-x left top; font-size: 13px; height: 19px; }
      table#outer td.left dl .wp-menu-toggle{ clear:right; cursor:hand; float:right; height: 29px; margin: 0px 2px 0 0; width: 23px; background: transparent url(../wp-admin/images/menu-bits.gif) no-repeat scroll left -109px; -moz-background-clip: border; -moz-background-inline-policy: continuous; -moz-background-origin: padding;}
			table#outer td.right dl .wp-menu-toggle{ clear:right; cursor:hand; float:right; height: 29px; margin: 0px 2px 0 0; width: 23px; background: transparent url(../wp-admin/images/fav-arrow.gif) no-repeat scroll 0 -1px; -moz-background-clip: border; -moz-background-inline-policy: continuous; -moz-background-origin: padding;}
			table#outer td.left dd { margin:0; padding: 10px 20px 10px 20px; }
			table#outer td.right dd { margin:0; padding: 5px 10px 5px 10px; background-color: #F1F1F1; }
			table#outer .info { color: #555; font-size: .85em; }
			table#outer p { padding:5px 0 5px 0; margin:0;}
			input.swg_warning:hover { background: #ce0000; color: #fff; }
			table#outer .mp3footer {text-align: center; font-size: .85em;}
			table#outer .mp3footer a, table#outer .mp3footer a:link { text-decoration:none; }
			table#outer td small { color: #555; font-size: .85em; }
			table#outer hr { border: none 0; border-top: 1px solid #BBBBBB; height: 1px; }
			table#outer ul { list-style:none; }
			table#outer ul.mybullet { list-style-type:disc; padding-left: 20px; }
      
      .ddpanel .ddpanelcontent{ border: 1px solid #DFDFDF; -moz-border-radius-bottomleft: 6px; -moz-border-radius-bottomright: 6px; -moz-border-radius-topleft: 6px; -moz-border-radius-topright: 6px; }
      .ddpanel .ddpanelcontent a{ text-decoration: none;}
      .ddpanel .ddpanelcontent a:hover{ color:#000000; }
      .ddpanel .ddpaneltab{ margin-right: 30px; font: bold 12px Arial; }   
      .ddpanel .ddpaneltab a{ float: right; text-decoration: none; letter-spacing: 1px; }
      .ddpanel .ddpaneltab a span{ float: left; display: block; background : #DFDFDF url(<?php echo GetBase64IconURL_mp3_Player('bg-header-gray.png'); ?>) repeat-x scroll left top; padding: 1px 12px 4px 13px; cursor: hand; border: 1px solid #DFDFDF; -moz-border-radius-bottomleft: 5px; -moz-border-radius-bottomright: 5px; }
      .ddpanel .ddpaneltab a:hover{ -moz-border-radius-bottomleft: 6px; -moz-border-radius-bottomright: 6px; color: #000000;}

		</style>
<div class="wrap">
<div id="icon-plugins" class="icon32"><br></div>
<?php _e("<h2>Plugin Settings: MP3 Player Options v" . $mp3_player_version . "</h2>"); ?>
<table id="outer"><tbody><tr><td class="left">
		<!-- *********************** BEGIN: Main Content ******************* -->
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<fieldset class="options">

                         <!--+++++++++++++++Folder for sidebar player++++++++++++++-->

           	<dl><a href="javascript:void(0);" onclick="toggle_visibility('menu_1');"><div class="wp-menu-toggle"></div></a>
			<dt><?php _e("<h4>Please enter folder name and configure height and width</h4>"); ?></dt> 
			<dd style="display : none" id="menu_1">
			<table border="0"><tbody><tr>
				<td width="475">
					<p style="line-height: 2em;"><input type="text" name="folder" value="<?php 
                                $newfldr = get_option('folder');
                               ($newfldr =='' ? $newfldr=$optionset['folder'] : $newfldr=get_option('folder')); 
                                  echo $newfldr; ?>" size="20"/>
             <?php _e("<strong>NO SLASHES PLEASE!</strong><br /> This is a \"showcase\" of your favorite songs.(Default folder is <code>mp3</code> if you want to make another folder your \"showcase\" folder you have to create the folder and put the new songs in there.) <br /><strong>For the Default Folder:</strong><br />Put the songs in"); 
?><code><?php echo $mp3_player_plugin_url; ?><?php _e("mp3/"); ?></code><?php _e("<br /><strong>For your newly created folder:</strong><br />Put the songs in"); ?><code><?php echo $mp3_player_plugin_url; ?><?php _e("yournewfolder/"); ?></code>
					</p>				
				</td>
                            <!--+++++++++++++++Height and Width option++++++++++++++-->
                
                        <td width="450" align="center">
                          <p style="line-height: 2em;"><font color="red"><?php _e("<br />LEAVE BLANK FOR DEFAULT <br />VALUES BELOW"); ?></font>
               <?php _e("<br />Enter the <strong>height</strong> of the MP3 player:"); ?><?php $hight = get_option('mp3_height'); ?>
             <input type="text" name="mp3_height" value="<?php
                               ($hight=='' ? $hight=$optionset['mp3_height3'] : $hight); 
                                  echo $hight; ?>" size="20"/><br />
               <?php _e("Enter the <strong>width</strong> of the MP3 player:"); ?><?php $witf = get_option('mp3_width'); ?>
             <input type="text" name="mp3_width" value="<?php 
                               ($witf=='' ? $witf=$optionset['mp3_width3'] : $witf); 
                                  echo $witf; ?>" size="20"/><br />
                     <?php _e("<strong>Suggested Heights and Widths:</strong>"); ?>
                           <table class="widefat" style="width: 85%;"> 
                      		<thead>
					<tr>
						<th scope="col"><?php _e("<strong>MP3 Player</strong>"); ?></th>
						<th scope="col"><?php _e("<strong>Height</strong>"); ?></th>
                                                <th scope="col"><?php _e("<strong>Width</strong>"); ?></th>
					</tr>
				</thead>
					<tbody><tr class="alternate">
						<td><?php _e("<strong>Baby Player</strong>"); ?></td>
						<td><?php _e("30"); ?></td>
                                                <td><?php _e("73"); ?></td>
					</tr>
					<tr>
						<td><?php _e("<strong>Medium Player</strong>"); ?></td>
                                                <td><?php _e("95"); ?></td>
						<td><?php _e("195"); ?></td>
					</tr>
					<tr class="alternate">
						<td><?php _e("<strong>Large Player</strong>"); ?></td>
                                                <td><?php _e("250"); ?></td>
						<td><?php _e("200"); ?></td>
					</tr>
					<tr>
						<td><?php _e("<strong>Google MP3 Player</strong>"); ?></td>
                                                <td><?php _e("28"); ?></td>
						<td><?php _e("300"); ?></td>
					</tr>
			                </tbody>
                           </table>
                        </p></td>
			</tr></tbody></table>
			</dd>
		</dl>
                                <!--+++++++++++++++Color Code option++++++++++++++-->
                <dl><a href="javascript:void(0);" onclick="toggle_visibility('menu_2');"><div class="wp-menu-toggle"></div></a>
                	<dt><?php _e("<h4>Pick Your Color Code Here</h4>"); ?></dt>
			<dd style="display : none" id="menu_2">
			<table border="0"><tbody><tr><html>
   <td>  <div style="position:relative;height:286px;
        width:531px;border:1px solid black;">
      <div id="gradientBox" style="cursor:crosshair;
        top:15px;position:absolute;left:15px;
        width:256px;height:256px;">
        <img id="gradientImg"
        style="display:block;width:256px;height:256px;"
        src="<?php echo $mp3_player_plugin_url; ?>/colorpicker/color_picker_gradient.png" />
        <img id="circle"
        style="position:absolute;height:11px;
        width:11px;"
        src="<?php echo $mp3_player_plugin_url; ?>/colorpicker/color_picker_circle.gif" />
      </div>
      <div id="hueBarDiv" style="position:absolute;
       left:310px;width:35px;
       height:256px;top:15px;">
        <img style="position:absolute;height:256px;
         width:19px;left:8px;"
         src="<?php echo $mp3_player_plugin_url; ?>/colorpicker/color_picker_bar.png" />
        <img id="arrows" style="position:absolute;
         height:9px;width:35px;left:0px;"
         src="<?php echo $mp3_player_plugin_url; ?>/colorpicker/color_picker_arrows.gif" />
      </div>
      <div style="position:absolute;left:370px;
           width:145px;
           height:256px;top:15px;">
      <div style="position:absolute;
         border: 1px solid black;
         height:50px;width:145px;top:0px;left:0px;">
        <div id="quickColor" style="position:absolute;
           height:50px;width:73px;top:0px;left:0px;">
        </div>

        <div id="staticColor" style="position:absolute;
           height:50px;width:72px;top:0px;left:73px;">
        </div>
      </div>
      <br />
      <table width="100%"
         style="position:absolute;top:55px;">
        <tr>
          <td>Old Color: </td>
          <td>
            <input size="8" type="text" id="picker" name="picker" value="<?php 
                                $newclr = get_option('hexBox');
                               ($newclr ? $newclr=get_option('hexBox') : $newclr=$optionset['hexBox']); 
                                 echo $newclr; ?>" />
          </td>
        </tr>
        <tr>
        <tr>
          <td>New Color: </td>
          <td>
            <input size="8" type="text" id="hexBox" name="hexBox" 
               onchange="hexBoxChanged();" />
          </td>
        </tr>
        <tr>
          <td>Red: </td>
          <td>
            <input size="8" type="text" id="redBox"
               onchange="redBoxChanged();" />
          </td>
        </tr>
        <tr>
          <td>Green: </td>
          <td>
            <input size="8" type="text" id="greenBox"
               onchange="greenBoxChanged();" />
          </td>
        </tr>
        <tr>
          <td>Blue: </td>
          <td>
            <input size="8" type="text" id="blueBox"
               onchange="blueBoxChanged();" />
          </td>
        </tr>
        <tr>
          <td>Hue: </td>
          <td>
            <input size="8" type="text" id="hueBox"
               onchange="hueBoxChanged();" />
          </td>
        </tr>
        <tr>
          <td>Saturation: </td>
          <td>
            <input size="8" type="text"
               id="saturationBox"
               onchange="saturationBoxChanged();" />
          </td>
        </tr>
        <tr>
          <td>Value: </td>
          <td>
            <input size="8" type="text" id="valueBox"
               onchange="valueBoxChanged();" />
          </td>
        </tr>
      </table>
      </div>
    </div>
    <script type="text/javascript">
      fixGradientImg();
      var currentColor = Colors.ColorFromRGB(64,128,128);
      new dragObject("arrows", "hueBarDiv",
          arrowsLowBounds, arrowsUpBounds,
          arrowsDown, arrowsMoved, endMovement);
      new dragObject("circle", "gradientBox",
          circleLowBounds, circleUpBounds,
          circleDown, circleMoved, endMovement);
      colorChanged('box');
    </script>
                       </tr></tbody></table>
			</dd>
		</dl>
                <dl><a href="javascript:void(0);" onclick="toggle_visibility('menu_3');"><div class="wp-menu-toggle"></div></a>
                        <dt><?php _e("<h4>Which MP3 player do you want?</h4>"); ?></dt>
			<dd style="display : none" id="menu_3">
                        <table border="0"><tbody><tr>


                                <!--+++++++++++++++Player option++++++++++++++-->

                     <td align="center">
                     <table class="widefat" style="width: 100%;">
                       <p style="line-height: 2em;">
                           <select style="width: 15%;"  id="ply_op" onchange="showplayer(this,4)" name="ply_op"><?php $opt_ply = get_option('ply_op'); ?>
                            <option value="1" <?php if( $opt_ply == '1'){ echo 'selected'; } ?>>1</option> 
                            <option value="2" <?php if( $opt_ply == '2'){ echo 'selected'; } ?>>2</option>
                            <option value="3" <?php if( $opt_ply == '3'){ echo 'selected'; } ?>>3</option>
                           </select><?php _e("Pick a number between 1-3 (look below for details)"); ?>
                        </p>
                               <thead>
                                       <tr>
                                           <th scope="row"><?php _e("<strong>(1) Baby Player Single Song</strong>"); ?></th>
                                           <th scope="row"><?php _e("<strong>(2) Medium Player</strong>"); ?></th>
                                           <th scope="row"><?php _e("<strong>(3) Large Player</strong>"); ?></th>
                                       </tr>
                               </thead>
                               <tbody>
                                       <tr class="alternate">

                                        <?php echo embed_table_player(1); ?>
                          <div id="player16" style="display:<?php echo ($numr1 == '6' ? 'block' : 'none'); ?>">
                           <object data="http://www.google.com/reader/ui/3247397568-audio-player.swf?audioUrl=<?php
                            $mp3_filer = get_option('ss_mp3'); 
                            $playlst = $mp3_player_plugin_url . 'mp3/' . $mp3_filer; 
                            echo $playlst; ?>" type="application/x-shockwave-flash" height="28" width="300">
                             <param name="bgcolor" value="#000000">
                             <param name="flashvars" value="playerMode=embedded">
                             <param name="src" value="http://www.google.com/reader/ui/3247397568-audio-player.swf?audioUrl=<?php echo $playlst; ?>">
                             <param name="wmode" value="window"><param name="quality" value="best">
                           </object>
                          </div> 

                                    <?php _e("<br />Enter the file name for the single song player if option is 1."); ?>
                                      <input type="text" name="ss_mp3" value="<?php $single = get_option('ss_mp3');
                                          ($single =='' ? $single=$optionset['ss_mp3'] : $single); 
                                              echo $single; ?>" size="20"/>
                                        <?php _e("<br /><strong>(USAGE: \"file_name.mp3\" and put the (1) file into "); ?>
                                         <?php echo $mp3_player_plugin_url; ?><?php _e("mp3/)</strong>"); ?>  
                                                </div>
                                            </td>     
                                        <?php echo embed_table_player(2); ?>
                                                </div>
                                            </td>
                                        <?php echo embed_table_player(3); ?>                                       
                                                </div>
                                            </td>
                                       </tr>
                               </tbody>
                     </table>
                    </td>
			</tr></tbody></table>
			</dd>
		</dl>
                      <!--+++++++++++++++++++Misc options++++++++++++++++++-->

                <dl><a href="javascript:void(0);" onclick="toggle_visibility('menu_4');"><div class="wp-menu-toggle"></div></a>
                	<dt><?php _e("<h4>Misc. Options</h4>"); ?></dt>
			<dd style="display : none" id="menu_4">
			<table border="0"><tbody><tr>

                            <!--+++++++++++++++++++Align option++++++++++++++++++-->

				<td width="300"><p><?php _e("<strong>Align Player</strong><br />"); ?></p>
                                 <select name="mp3_aligner"><?php $aligner= get_option('mp3_aligner'); ?>
                                   <option value="left" <?php if( $aligner == 'left'){ echo 'selected'; } ?>>Left</option> 
                                   <option value="center" <?php if( $aligner== 'center'){ echo 'selected'; } ?>>Center</option>
                                   <option value="right" <?php if( $aligner == 'right'){ echo 'selected'; } ?>>Right</option>
                                 </select><br /><?php _e("Default option is 'Left'"); ?>
                                </td>  
	    
                            <!--++++++++++++++++++Autoplay option++++++++++++++++++-->

                                <td width="300"><p>
                               <?php _e("<strong>Autoplay Select Yes or No <br />(to start music automatically)</strong><br />"); ?></p>
                                 <select name="mp3_ap"><?php $atoply = get_option('mp3_ap'); ?>
                                   <option value="no" <?php if( $atoply == 'no'){ echo 'selected'; } ?>>Select</option>  
                                   <option value="yes" <?php if( $atoply == 'yes'){ echo 'selected'; } ?>>Yes</option>
                                   <option value="no" <?php if( $atoply == 'no'){ echo 'selected'; } ?>>No</option>
                                 </select><br /><?php _e("Default option is 'no'"); ?>
                                </td>

                            <!--++++++++++++++++++Shuffle Option++++++++++++++++++-->

                                <td width="300"><p><?php _e("<strong>Shuffle Songs on Player</strong><br />"); ?></p>
                                 <select name="shuff"><?php $shufl = get_option('shuff'); ?>
                                   <option value="no" <?php if( $shufl == 'no'){ echo 'selected'; }?>>Select</option>  
                                   <option value="yes" <?php if( $shufl == 'yes'){ echo 'selected'; } ?>>Yes</option>
                                   <option value="no" <?php if( $shufl == 'no'){ echo 'selected'; } ?>>No</option>
                                 </select><br /><?php _e("Default option is 'no' <br />(This option makes <br />the player shuffle the<br /> songs everytime.)"); ?>
                                </td>                             
                              <tr>                            
                            <!--++++++++++++++++++Transparent option++++++++++++++++++-->

                                <td width="300"><p><?php _e("<strong>Transparency</strong><br />"); ?></p>
                                 <select name="transp"><?php $trans = get_option('transp'); ?>
                                   <option value="yes" <?php if( $trans == 'yes'){ echo 'selected'; }?>>Select</option>  
                                   <option value="yes" <?php if( $trans == 'yes'){ echo 'selected'; } ?>>Yes</option>
                                   <option value="no" <?php if( $trans == 'no'){ echo 'selected'; } ?>>No</option>
                                 </select><br /><?php _e("Default option is 'yes' <br />(This options makes <br />the player transparent(yes=not scrollable)<br /> or not (no=scrollable))"); ?>
                                </td>                            
                              
                            <!--++++++++++++++++++Numbers next to titles option++++++++++++++++++-->

                                <td width="300"><p><?php _e("<strong>Show Numbers</strong><br />"); ?></p>
                                 <select name="number"><?php $numm = get_option('number'); ?>
                                   <option value="yes" <?php if( $numm == 'yes'){ echo 'selected'; }?>>Select</option>  
                                   <option value="yes" <?php if( $numm == 'yes'){ echo 'selected'; } ?>>Yes</option>
                                   <option value="no" <?php if( $numm == 'no'){ echo 'selected'; } ?>>No</option>
                                 </select><br /><?php _e("Default option is 'yes' <br />(This options makes <br />the player display numbers(yes)<br /> or not (no) beside the title in player)"); ?>
                                </td>    
                                
                            <!--++++++++++++++++++RSS option++++++++++++++++++-->
                                <td width="300"><p><?php _e("<strong>Do you want the music RSS to show up above the player?</strong><br />"); ?></p>
                                 <select name="mp3_RSS" id="mp3_RSS" onchange="showhide_func('mp3_RSS','1','layer2')" ><?php $RSSvar = get_option('mp3_RSS'); ?>
                                  <option value="" <?php if( $RSSvar == ''){ echo 'selected'; } ?>>Select</option> 
                                  <option value="yes" <?php if( $RSSvar == 'yes'){ echo 'selected'; } ?>>Yes</option>
                                  <option value="no" <?php if( $RSSvar == 'no'){ echo 'selected'; } ?>>No</option>
                                 </select><br /><br />
         <div id="layer2" style="display:<?php echo ($RSSvar != 'no' ? 'block' : 'none'); ?>;">
           <p><?php _e("Please enter a title to display above player:"); ?>
             <input type="text" name="RSS_title" value="<?php 
                                $varrss=get_option('RSS_title'); 
                                 ($varrss =='' ? $varrss=$optionset['RSS_title'] : $varrss); 
                                  echo $varrss; ?>" size="50"/><?php _e("<br />(e.g. Subscribe to my music feed)"); ?></p><br />
           <p><?php _e("Please enter a <strong>valid</strong> email address to set up RSS correctly:<br />"); ?>
             <input type="text" name="RSS_email" value="<?php 
                                $vareml=get_option('RSS_email'); 
                                 ($vareml =='' ? $vareml=$optionset['RSS_email'] : $vareml); 
                                  echo $vareml; ?>" size="50"/></p><br />
           <p><?php _e("Please enter your Music RSS Name:"); ?>
             <input type="text" name="blog_name" value="<?php 
                                $varblg=get_option('blog_name'); 
                                 ($varblg =='' ? $varblg=$optionset['blog_name'] : $varblg); 
                                  echo $varblg; ?>" size="50"/></p><br />
           <p><?php _e("Please enter enter a brief description of your music RSS <strong>(brief)</strong>:<br />"); ?>
             <input type="text" name="grrblog" value="<?php 
                                $vargrr=get_option('grrblog'); 
                                 ($vargrr =='' ? $vargrr=$optionset['grrblog'] : $vargrr); 
                                  echo $vargrr; ?>" size="50"/></p><br />
         </div>
                              </tr>
                            <!--++++++++++++++++++Pop Mp3 option++++++++++++++++++-->                              
                              <tr>
                                <td width="300"><p><?php _e("<strong>Show Pop-up Button</strong><br />"); ?></p>
                                 <select name="pop_mp3"><?php $pop = get_option('pop_mp3'); ?>
                                   <option value="no" <?php if( $pop == 'no'){ echo 'selected'; }?>>Select</option>  
                                   <option value="yes" <?php if( $pop == 'yes'){ echo 'selected'; } ?>>Yes</option>
                                   <option value="no" <?php if( $pop == 'no'){ echo 'selected'; } ?>>No</option>
                                 </select><br /><?php _e("Default option is 'no' <br />(This options makes <br />the player show button for popup(yes)<br /> or not (no) below the player)"); ?>
                                </td> 
                              </tr>
                                </td>
              		</tr></tbody></table>
			</dd>
		</dl>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="pop_mp3,number,transp,shuff,folder,ss_mp3,mp3_aligner,RSS_title,mp3_height,mp3_width,ply_op,grrblog,blog_name,RSS_email,mp3_RSS,picker,hexBox,mp3_num1,mp3_num2,mp3_num3,mp3_ap" />
<hr />
<p class="submit"><?php _e("<strong>--If updating other options besides color options copy paste old color into new color slot, then hit Save Changes button<br />--If updating color and any other options hit Save Changes button</strong><br />"); ?>
<input type="submit" class="button-primary" value="<?php _e("Save Changes") ?>" /></p><?php _e("Don't forget to move some .mp3's to the folder"); ?><code><?php echo $mp3_player_plugin_url; ?><?php _e("mp3/"); ?></code>

<br />
<br />
<br />
<br />
</form>

                <!-- *********************** END: Main Content ********************* -->
		</td><!-- [left] -->

		<td class="right">
		<!-- *********************** BEGIN: Sidebar ************************ -->	

                      <!-- *********************** Sidebar MP3 ************************ -->	
	
		<dl><a class="newclass" href="javascript:void(0);" onclick="toggle_visibility('menu_11');"><div class="wp-menu-toggle"></div></a>
			<dt><?php _e("<h4>MP3 Player Displayed!!</h4>"); ?></dt>
			<dd style="display : block" id="menu_11">
          <?php include('mp3-play-widget.php'); ?>
			</dd>
		</dl>

                      <!-- *********************** Sidebar Links ************************ -->	

		<dl><a class="newclass" href="javascript:void(0);" onclick="toggle_visibility('menu_5');"><div class="wp-menu-toggle"></div></a>
			<dt><?php _e("<h4>Links for Help/Info</h4>"); ?></dt>
			<dd style="display : none" id="menu_5">
			<ul>
				<a class="lhome" href="http://www.thomasnorberg.com/plugins-used/mp3-player-plugin-for-wordpress/">Plugin's Homepage</a>
                                <a class="lhome" href="javascript:void(0);" onclick="toggle_visibility('menu_10');">Post/Page Configuration Settings (examples) SCROLL DOWN AFTER CLICK</a>
                                <a class="lhome" href="javascript:void(0);" onclick="toggle_visibility('menu_9');">Connect to the forum SCROLL DOWN AFTER CLICK</a>
				<a class="lwp" href="http://wordpress.org/tags/mp3-player-plugin-for-wordpress">WordPress Support</a>
                                <a class="prbeat" href="http://www.premiumbeat.com">PremiumBeat.com</a>
                                <a class="tools" href="http://www.thomasnorberg.com/base64img.php">Want to make icons into text?</a>            
                                <a class="chat" href="javascript:void(0);" onclick="toggle_visibility('chat');">Chat with me!</a>
			</ul>			
			</dd>
		</dl>

                      <!-- *********************** Sidebar Invisible Chat ************************ -->	

                <dl style="display : none" id="chat">
                <dt><?php _e("<h4>Chat with me directly!</h4>"); ?></dt>
                         <dd >
            <div>
                <object width="250" height="360" id="obj_1253076255765">
                  <param name="movie" value="http://tomblogchat.chatango.com/group"/>
                  <param name="wmode" value="transparent"/>
                  <param name="AllowScriptAccess" VALUE="always"/>
                  <param name="AllowNetworking" VALUE="all"/>
                  <param name="AllowFullScreen" VALUE="true"/>
                     <param name="flashvars" value="cid=1253076255765&amp;a=0052A3&amp;b=100&amp;c=FFFFFF&amp;d=FFFFFF&amp;f=87&amp;l=999999&amp;q=999999&amp;r=100&amp;s=1&amp;t=0&amp;ab=0"/>
                       <embed id="emb_1253076255765" src="http://tomblogchat.chatango.com/group" width="250" height="360" wmode="transparent" allowScriptAccess="always" allowNetworking="all" type="application/x-shockwave-flash" allowFullScreen="true" flashvars="cid=1253076255765&amp;a=0052A3&amp;b=100&amp;c=FFFFFF&amp;d=FFFFFF&amp;f=87&amp;l=999999&amp;q=999999&amp;r=100&amp;s=1&amp;t=0&amp;ab=0">
                       </embed>
                </object>
            </div>
         <dd>
          </dl>

                      <!-- *********************** Sidebar Contribution ************************ -->	

		<dl><a class="newclass" href="javascript:void(0);" onclick="toggle_visibility('menu_6');"><div class="wp-menu-toggle"></div></a>
			<dt><?php _e("<h4>Contribution?</h4>"); ?></dt>
			<dd style="display : none" id="menu_6">
			<p style="font-size: 8pt;"><?php _e("I have spent a lot of time in development for this plugin. Any donation would be highly appreciated."); ?></p>
			<ul>
				<li><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                      <input type="hidden" name="cmd" value="_s-xclick"/>
                                      <input type="hidden" name="hosted_button_id" value="6149599"/>
                                      <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif"  name="submit" alt="PayPal - The safer, easier way to pay online!"/>
                                    <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"/>
                                   </form>
                                </li>
                                <li><p>
<script type="text/javascript" src="http://sfx-images.mozilla.org/utw/switch.js"></script>
<span class="sfx-affiliates-utw-button size-120x240">
    <a class="ff35" style="display:none;" href="http://addons.mozilla.org" title="Try Add-ons!">
        <img border="0" src="http://sfx-images.mozilla.org/utw/120x240_ff35.png" alt="You Rock.  Thanks for using Firefox. Try Add-ons!" />
    </a>
    <a class="ff" style="display:none;" href="http://www.mozilla.com/firefox/upgrade.html?from=sfx&amp;uid=259921&amp;t=478" title="Upgrade the Web to Firefox 3.5!">
        <img border="0" src="http://sfx-images.mozilla.org/utw/120x240_ff.png" alt="Thanks for using Firefox.  Don't miss the upgrade.  Download Firefox 3.5!" />
    </a>
    <a class="ie" style="display: none;" href="http://www.mozilla.com/firefox/ie.html?from=sfx&amp;uid=259921&amp;t=480" title="Upgrade to Firefox 3.5!">
        <img border="0" src="http://sfx-images.mozilla.org/utw/120x240_ie.png" alt="You don't use VHS...then why Internet Explorer?  Upgrade to Firefox 3.5!" />
    </a>
    <a class="other" href="http://www.mozilla.com/firefox/firefox.html?from=sfx&amp;uid=259921&amp;t=481" title="Upgrade to Firefox 3.5!">
        <img border="0" src="http://sfx-images.mozilla.org/utw/120x240_other.png" alt="You're settling for good when there's awesome.  Upgrade to Firefox 3.5!" />
    </a>
</span>
<script type="text/javascript">init_utw()</script>
</p></li>
			</ul>			
			</dd>
		</dl>

                      <!-- *********************** Sidebar Embed in Templates ************************ -->
	
		<dl><a class="newclass" href="javascript:void(0);" onclick="toggle_visibility('menu_7');"><div class="wp-menu-toggle"></div></a>
			<dt><?php _e("<h4>Embed in templates</h4>"); ?></dt>
			<dd style="display : none" id="menu_7">
			   <ul> 
                              <li>
                                <p style="font-size: 8pt;"><?php _e("You can also add the MP3 player to your template pages by adding <br /><code>&#60;?php mp3_embed(); ?&#62;</code><br />You can also add the RSS feed link to your template pages by adding <br /><code>&#60;?php embed_RSS(); ?&#62;</code>"); ?></p>       </li>
                           </ul>					
			</dd>
		</dl>

                       <!--++++++++++++++++++Sidebar ShortCode Options++++++++++++++++++-->

                <dl><a class="newclass" href="javascript:void(0);" onclick="toggle_visibility('menu_8');"><div class="wp-menu-toggle"></div></a>   
                	<dt><?php _e("<h4>[mp3_embed]</h4>"); ?></dt>
			<dd style="display : none;" id="menu_8">
			<table border="0"><tbody><tr>       
                      <td><table class="widefat" style="width: 100%;">
				<thead>
					<tr>
						<th scope="col"><?php _e("<strong>Attribute</strong>"); ?></th>
						<th scope="col"><?php _e("<strong>What it does</strong>"); ?></th>
					</tr>
				</thead>
					<tbody><tr class="alternate">
						<td><?php _e("<strong>mp3_aligns</strong>"); ?></td>
						<td><?php _e("Align the player"); ?></td>
					</tr>
					<tr>
						<td><?php _e("<strong>aps</strong>"); ?></td>
						<td><?php _e("Adjust autoplay option yes or no"); ?></td>
					</tr>
					<tr class="alternate">
						<td><?php _e("<strong>colors</strong>"); ?></td>
						<td><?php _e("Color of the mp3 player in hex #HexNUM or #Hex"); ?></td>
					</tr>
					<tr>
						<td><?php _e("<strong>nums</strong>"); ?></td>
						<td><?php _e("type of blog_plyrs 1-5 Try them out!"); ?></td>
					</tr>
					<tr class="alternate">
						<td><?php _e("<strong>mp3wids</strong>"); ?></td>
						<td><?php _e("adjusts the width of the player"); ?></td>
					</tr>

					<tr>
						<td><?php _e("<strong>mp3highs</strong>"); ?></td>
						<td><?php _e("adjusts the height of the player"); ?></td>
					</tr>
                                        <tr class="alternate">
						<td><?php _e("<strong>blog_plyrs</strong>"); ?></td>
						<td><?php _e("for which player you want 1-3"); ?></td>
					</tr>
					<tr>
						<td><?php _e("<strong>playlst</strong>"); ?></td>
						<td><?php _e("location of exact file (i.e. http://www.yoursite.com/file_name.mp3) or don't set if option blog_plyrs=\"2\" or \"3\""); ?></td>
					</tr>
                                        <tr class="alternate">
						<td><?php _e("<strong>id</strong>"); ?></td>
						<td><?php _e("If you want more than one of the same player on one page"); ?></td>
					</tr>

					<tr>
						<td><?php _e("<strong>playlistfolder</strong>"); ?></td>
						<td><?php _e("a playlist option to set up multiple playlists on webpage. Type in folder of .mp3 files under the mp3 player plugin for wordpress. (<code>$mp3_player_plugin_url</code><strong>yourfolderhere</strong>)"); ?></td>
					</tr>
                                        <tr class="alternate">
						<td><?php _e("<strong>shuffle</strong>"); ?></td>
						<td><?php _e("If you want all the songs to shuffle every time you load your site(default is no)"); ?></td>
					</tr>
                                        <tr>
						<td><?php _e("<strong>transparent</strong>"); ?></td>
						<td><?php _e("yes if you want transparency no if you want player on top"); ?></td>
					</tr>
                                        <tr class="alternate">
						<td><?php _e("<strong>show</strong>"); ?></td>
						<td><?php _e("If you want the song number to show next to song title (default is yes)"); ?></td>
					</tr>
                                        <tr>
						<td><?php _e("<strong>pop_mp3</strong>"); ?></td>
						<td><?php _e("yes if you want a button to show under player to pop-up player"); ?></td>
					</tr>
			</tbody></table></td></tr>
                     </td>
              		</tr></tbody></table>
			</dd>
		</dl>

		<!-- *********************** END: Sidebar ************************ -->
		</td> <!-- [right] -->
		</tr></tbody></table> <!-- [outer] -->

                <!-- *********************** BEGIN: Footer ********************* -->
 <table id="outer"><tbody><tr>
           <td class="left">
               <dl><a href="javascript:void(0);" onclick="toggle_visibility('menu_9');"><div class="wp-menu-toggle"></div></a>
			<dt><?php _e("<h4>Show the Forum</h4>"); ?></dt>
			  <dd style="display : none" id="menu_9"><iframe height="410" width="100%" frameBorder="1" src="http://www.thomasnorberg.com/plugins-used/mp3-player-plugin-for-wordpress-forum/">your browser does not support IFRAMEs</iframe> 
                          </dd>
               </dl>
               <dl><a href="javascript:void(0);" onclick="toggle_visibility('menu_10');"><div class="wp-menu-toggle"></div></a>
			<dt><?php _e("<h4>How to Configure posts and pages</h4>"); ?></dt>
			  <dd style="display : none" id="menu_10">        
                             <iframe height="410" width="100%" frameBorder="1" src="http://www.thomasnorberg.com/plugins-used/test-mp3-player/">your browser does not support IFRAMEs</iframe>
                          </dd>
               </dl>
		          <div id="mypanel" class="ddpanel">
             <div id="my-message" style="background-color: #DA3124; display: block;" class="ddpanelcontent" onclick="toggle_visibility('my-message');">
                <p style="padding:10px">
                   <?php _e("<strong>If you want the full functionality of the plugin please download <a href='http://wordpress.org/extend/plugins/my-quicktags/' title='My Quicktags Plugin' >My Quicktags Plugin</a>         
                   </strong>"); ?>
                </p>
             </div>
                 <div id="mypaneltab" class="ddpaneltab">
                     <a href="javascript:void(0);" onclick="toggle_visibility('my-message');"><span>Hide Message</span></a>
                 </div>
              </div>
                 <p class="mp3footer">
                <a href="http://www.thomasnorberg.com/plugins-used/mp3-player-plugin-for-wordpress/">MP3 Player Plugin for Wordpress v<?php echo $mp3_player_version; ?></a> &copy; Copyright 2009 <a href="http://www.thomasnorberg.com/">Thomas Norberg</a></p>
         </td>
</tr></tbody></table>
<?php
      
function player_check($blog_plyr, $nums = NULL)
{               global $mp3_player_plugin_url, $mp3_player_version, $mp3_filer;
                $playlistfolder = 'mp3';
                $ap = 'no';
                $mp3_align = 'left'; 
  if( $blog_plyr == '1')
   { $settings = array(
		'blog_plyr' => $mp3_player_plugin_url . 'player_options/playerMini.swf',
		'plyrs' => 'adminplayerMini',
                'soundscolors' => '#1FBF26',
                'sounds' => 'soundPath',
                'mp3wids' => '73',
                'mp3highs' => '30',
                'mp3_filer' => get_option('ss_mp3'),
                'playlst' => $mp3_player_plugin_url . 'mp3/' . $mp3_filer,
                'playlistfolder' => ''
	              );
   } 
  if( $blog_plyr == '2')
   { $settings = array(
		'blog_plyr' => $mp3_player_plugin_url . 'player_options/playerMultiple.swf',
		'plyrs' => 'adminplayerMultiple',
                'soundscolors' => '#345',
                'sounds' => 'playlistPath',
                'mp3wids' => '195',
                'mp3highs' => '95',
                'playlst' => $mp3_player_plugin_url . 'playlist.php'           
	               );
    }
  if( $blog_plyr == '3')
   { $settings = array(
		'blog_plyr' => $mp3_player_plugin_url . 'player_options/playerMultipleList.swf',
		'plyrs' => 'adminplayerMultipleList',
                'soundscolors' => '#F30101',
                'sounds' => 'playlistPath',
                'mp3wids' => '200',
                'mp3highs' => '250',
                'playlst' => $mp3_player_plugin_url . 'playlist.php'
                       );
   } 
 ?>
<!-- Begin MP3 Player for Wordpress Version "<?php echo $mp3_player_version; ?>"-->
    <div id="<?php echo $settings['plyrs']. 'player' . $nums; ?>" align="<?php echo $mp3_align; ?>">
       <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab" width="<?php echo $settings['mp3wids']; ?>" height="<?php echo $settings['mp3highs']; ?>">
    
          <param name="movie" value="<?php echo $settings['blog_plyr']; ?>" />
          <param name="FlashVars" value="autoPlay=<?php echo $ap; ?>&amp;<?php echo $settings['sounds']; ?>=<?php echo $settings['playlst']; ?>?folder=<?php echo $playlistfolder; ?>&amp;overColor=<?php echo $settings['soundscolors'] . '&amp;playerSkin=' . $nums; ?>" />
<!--[if !IE]> <-->
      <script type="text/javascript" src="<?php echo $mp3_player_plugin_url . 'swfobject.js'; ?>"></script>

       <div id="<?php echo $settings['plyrs'] . $nums; ?>">
         <img src="<?php echo $mp3_player_plugin_url . 'img/noflash.gif'; ?>" alt="Flash required " />
       </div>

         <script type="text/javascript">
            var so = new SWFObject("<?php echo $settings['blog_plyr']; ?>", "mymovie", "<?php echo $settings['mp3wids']; ?>", "<?php echo $settings['mp3highs']; ?>", "7", "#FFFFFF");  
           so.addVariable("autoPlay","<?php echo $ap; ?>")
           so.addVariable("<?php echo $settings['sounds']; ?>","<?php echo $settings['playlst']; ?>?folder=<?php echo $playlistfolder . '&amp;overColor=' . $settings['soundscolors'] . '&amp;playerSkin=' . $nums; ?>")
           so.write("<?php echo $settings['plyrs'] . $nums; ?>");
         </script>  		

<!--> <![endif]-->
</object></div>
<!-- MP3 Player Plugin For Wordpress End Version "<?php echo $mp3_player_version; ?>"-->
<?php
}    
function embed_table_player($id){?>
<td width="250">
         <?php echo player_check($id); ?>
<?php 
    if($id == '1')
      { $numr = $numr1;
        $entry = 'playlst="http://www.yoursite.com/yourmp3.mp3"';
        $entry2 = '<strong>Google MP3 Player is option number 6.</strong>';
      } 
    if($id=='2')
      { $numr = $numr2;
        $entry = 'blog_plyrs="2"';
      }
    if($id=='3')
      { $numr = $numr3;
        $entry = 'blog_plyrs="3"';
      }
    ?>
          <?php _e("<strong>Use this to embed into posts and pages: </strong><br /><code>[mp3_embed $entry]</code>"); ?><?php if($id=='1') { _e("<br />$entry2");} ?>
                   <div id="player4<?php echo $id;?>" style="display:<?php echo ($opt_ply == $id ? 'block' : 'none');  ?>; width: 80%;">
<?php _e("Please choose a number between 1 and 5 to change the look of the MP3 player."); ?><br />
                             <select style="width: 55%;" name="mp3_num<?php echo $id;?>" onchange="showplayer(this,<?php echo $id;?>)">
                                <?php $numr = get_option('mp3_num'.$id); ?>
                                   <option value="1" <?php if( $numr == '1'){ echo 'selected'; } ?>>1</option>
                                   <option value="2" <?php if( $numr == '2'){ echo 'selected'; } ?>>2</option>
                                   <option value="3" <?php if( $numr == '3'){ echo 'selected'; } ?>>3</option>
                                   <option value="4" <?php if( $numr == '4'){ echo 'selected'; } ?>>4</option>
                                   <option value="5" <?php if( $numr == '5'){ echo 'selected'; } ?>>5</option>
<?php if($id=='1'){?>              <option value="6" <?php if( $numr == '6'){ echo 'selected'; } ?>>6</option>
<?php } ?>
                             </select>

                          <div id="player<?php echo $id;?>1" style="display:<?php echo ($numr == '1' ? 'block' : 'none'); ?>">
                            <?php echo player_check($id,1); ?>
                          </div>

                          <div id="player<?php echo $id;?>2" style="display:<?php echo ($numr == '2' ? 'block' : 'none'); ?>">
                           <?php echo player_check($id,2); ?>
                          </div>

                          <div id="player<?php echo $id;?>3" style="display:<?php echo ($numr == '3' ? 'block' : 'none'); ?>">
                            <?php echo player_check($id,3); ?>
                          </div>

                          <div id="player<?php echo $id;?>4" style="display:<?php echo ($numr == '4' ? 'block' : 'none'); ?>">
                            <?php echo player_check($id,4); ?>
                          </div> 

                          <div id="player<?php echo $id;?>5" style="display:<?php echo ($numr == '5' ? 'block' : 'none'); ?>">
                            <?php echo player_check($id,5); ?>
                          </div> 
<?php }
?>