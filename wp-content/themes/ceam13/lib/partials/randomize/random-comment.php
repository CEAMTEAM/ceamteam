		<div class="size2of3 center">
			
		<?php
		  // $post_id = 2;  // Put the 'testimonials' id here
		   $comments = get_comments("status=approve");
		   if ($comments) {
		     $ndx = mt_rand(1,sizeof($comments)) - 1;
		     $comment = $comments[$ndx]; ?>
		     <div class='comment_wrapper'>
		     <h2>Kind Words</h2>
		       <p class='comment_author'>
		         <?php echo "Testimonial by: $comment->comment_author"; ?>
		       </p>
		       <p class='comment_content'>
		         <?php echo $comment->comment_content; ?>
		       </p>
		     </div>
		   <?php }
		?>

		</div>