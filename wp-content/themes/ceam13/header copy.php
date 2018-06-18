<!doctype html>
<html lang=en-US xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta charset=UTF-8>
<title><?php wp_title(''); ?></title>

<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

<?php wp_head(); ?>

<script type="text/javascript" src="//use.typekit.net/ooi6gyg.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<link href="<?php bloginfo('template_url'); ?>/style.css?v=<?=time();?>" rel="stylesheet"/>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="icon" href="<?php bloginfo('template_url'); ?>/lib/images/favico.ico" type="image/x-icon" />

<script src="<?php bloginfo('template_url'); ?>/lib/js/modernizr.js"></script>

<?php // if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>


</head>
<body <?php body_class(); ?>>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-24190198-26', 'ceamteam.org');
  ga('send', 'pageview');

</script>

<header role="banner">
	<div>
		<div class="p0 width line relative">
			<div class="pad1to1sm line boxShadowBottom condensed">
				<h1 class="left">Children's Education Alliance of Missouri <a href="tel:314-454-6544">314-454-6544</a> | <a href="https://maps.google.com/maps?q=1310+Papin+Street,+Suite+106+St.+Louis,+MO+63103&ie=UTF-8&hq=&hnear=0x87d8b30d0b188943:0xacb0b4907a44e70d,1310+Papin+St+%23106,+St+Louis,+MO+63103&gl=us&ei=Yj_dUq3CGZW0sQSh4YCwDg&ved=0CCwQ8gEwAA">1310 Papin Street,  Suite 106 St. Louis, MO 63103</a></h1>
				<div class="right">					
					<?php // echo  wpsocialite_markup(); ?>
					<a href="https://www.facebook.com/CEAMofficial"><span aria-hidden="true" class="icon-facebook"></span></a>
					<a href="https://twitter.com/CEAMTEAM"><span aria-hidden="true" class="icon-twitter"></span></a>
					<!--
<a href="http://instagram.com/inclusivestl"><span aria-hidden="true" class="icon-instagram"></span></a>
					<a href="http://www.linkedin.com/company/diversity-awareness-partnership"><span aria-hidden="true" class="icon-linkedin"></span></a>
					<a href="http://www.flickr.com/photos/100542849@N07/"><span aria-hidden="true" class="icon-flickr"></span></a>
					<a href="https://plus.google.com/b/104089976664356738137/104089976664356738137/about"><span aria-hidden="true" class="icon-google-plus"></span></a>
					<a href=""><span aria-hidden="true" class="icon-pinterest"></span></a>
-->
					
					<a class="" href="http://ceamteam.nationbuilder.com/add_to_newsletter"><span aria-hidden="true" class="icon-envelope"></span> Subscribe</a> 
				</div>
				
			</div>
			<div class="line textC">
				<h2 class="p0"><a href="<?php bloginfo('url');?>"><span class="two-tone">CEAM</span><span class="tagLine">Reimagining Education</span></a></h2>
			</div>

			<nav role="navigation" class="line condensed"><?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => false, 'menu_id' => 'rav', 'menu_class' => false ) ); ?>
				<a class="menu" href=""><span aria-hidden="true" class="icon-point-right"> Menu</span></a>
			</nav>
		</div>
	</div>
</header>

<div>
<!-- <div class="width"> -->