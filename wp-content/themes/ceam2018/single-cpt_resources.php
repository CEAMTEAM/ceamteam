<?php get_header(); ?>
  
	<?php if (have_posts()) : while (have_posts()) : the_post();?>


		<div class="page">
      <div class="page__container">
        <div class="page__content-padding">
          <h2 class="content__heading"><?php the_title()?></h2>


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


			  <?php the_content() ?>
    </div>
  </div>
</div>

	<?php endwhile; endif; ?>


<?php get_footer(); ?>
