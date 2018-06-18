<?php 

	//http://www.noupe.com/how-tos/how-to-design-and-program-a-facebook-landing-page.html

	require 'facebook.php';
	
	  $app_id  	= "YOUR_APP_ID";
	  $app_secret 	= "YOUR_APP_SECRET";
	
	$facebook = new Facebook(array(
	  'appId'  => $app_id,
	  'secret' => $app_secret,
	  'cookie' => true  
	));
	
	$signed_request = $facebook->getSignedRequest();
	$page_id 		= $signed_request["page"]["id"];		// Which page is the request coming from 		(You can use conditional statements to serve specific content)
	$page_admin 	= $signed_request["page"]["admin"];  	// Is the person viewing the page an ADMIN 		(0/1)
	$like_status 	= $signed_request["page"]["liked"];  	// Has the person viewing the page LIKED yet 	(0/1)
	$country 		= $signed_request["user"]["country"];  	// Where the user is from						(US, FR...)
	$locale 		= $signed_request["user"]["locale"];  	// Gives ISO and language country codes for the user	(en_US)
	
	// Get User ID
	$user = $facebook->getUser();
	



?>

<!DOCTYPE HTML>
<html lang=en-US>
<head>
	<!-- Add these three tags -->
	<title>FACEBOOK PAGE</title>
	<meta charset=UTF-8>
	<link rel=stylesheet href=css/style.css />
	<script type="text/javascript">
		window.fbAsyncInit = function() {
			FB.Canvas.setSize();
			// FB.Canvas.setAutoResize(); // Use if the page is going to be fluctuate in height due to adding and removing content
		}
	</script>
	
	<!--
	Uncomment this to enable jQuery Library (I'll explain this more later)
	<script src=http://code.jquery.com/jquery-latest.js></script>
	-->
</head>
<body>

<?php 
	
	//USE this for testing to make sure that it's working
	//Delete or comment code out for produciton

	echo 'Page ID: ' . $page_id . '<br/ >';
	echo 'Page Admin: ' . $page_admin . '<br/ >';
	echo 'Like Status: ' . $like_status . '<br/ >';
	echo 'Country: ' . $country . '<br/ >';
	echo 'Locale: ' . $locale . '<br/ >';

?>

<header></header>
<nav></nav>

<?php if(!$like_status): ?>
	
	<!-- 
	- if used has not liked then >
	
	- html code to display here 
	
	-->

<?php elseif($like_status): ?>
	
	<!-- 
	- if used has liked then >
	
	- Thanks for LIKING US! 
	
	-->
<?php endif;?>

<?php if($page_id == "23423423423424"): ?>
	
	<!-- 
	- if used has liked then >
	
	- Thanks for LIKING US! 
	
	-->
<?php endif;?>

<h1>User Interaction and Forms</h1>
<p></p>

<footer></footer>

<script src=http:connect.facebook.net/en_US/all.js></script>

<script type="text/javascript">
	FB.init({
		appid: '  ',
		status: true,
		cookies: true,
		xfbml: true
	});
</script>

<!--	
Uncoment to link to your own scripts
<script src=js/script.js></script>
-->
</body>
</html>