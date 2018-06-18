<div class="sidebar">
<?php 
	$announcement_title_1 = of_get_option('announcement_title_1');
	$announcement_copy_1 = of_get_option('announcement_copy_1');

	if ($announcement_title_1 !== '') { echo "<h2>".$announcement_title_1."</h2>";} 
	if ($announcement_copy_1 !== '') { echo "<p>".$announcement_copy_1."</p>";} 
	
	$sidebar = get_post_meta(get_the_ID(), 'rw_sidebar', true); 

	if ($sidebar !== '') { echo $sidebar;} 
?>
</div>