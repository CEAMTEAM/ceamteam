<?php get_header(); ?>

<div>

    <h1 class="em2 textC ltBlue pad1to1sm"><?php the_title();  ?></h1>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>

	<?php // if(has_post_thumbnail()) { the_post_thumbnail('full');} ?>


		<div class="center size3of4 listOn entry">

		<?php if ( is_single('7049') ) { ?>
		    <h2 class="textC">Brought to you by CEAM</h2>
		    <div class="records">
	          <input class="msip5-school typeahead" type="text" placeholder="Search by school's name..." />
	      </div>

        <div class="records">
          <input class="msip5-district typeahead" type="text" placeholder="Search by school's district..." />
        </div>
		<?php } ?>

		<?php if ( is_single('7466') ) { ?>
			<h2 class="textC">Brought to you by CEAM</h2>
      <div class="records">
        <input class="msip5-school typeahead" type="text" placeholder="Search by school's Name..." />
      </div>

      <div class="records">
        <input class="msip5-district typeahead" type="text" placeholder="Search by school's district..." />
      </div>
		<?php } ?>


    <?php if ( is_single('7782') ) { ?>
			<h2 class="textC">Brought to you by CEAM</h2>

      <div class="records">
        <input class="school-district typeahead" type="text" placeholder="Search by school's district..." />
      </div>

      <div class="records">
        <input class="superintendant-information typeahead" type="text" placeholder="Search by superintendent's Name..." />
      </div>
		<?php } ?>


			<?php the_content();?>

		</div>

	<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>
