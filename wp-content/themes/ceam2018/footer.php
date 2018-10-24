<!--footer section-->
<div class="footer__layer">
  <div class="footer__container">
    <div class="footer__item">
      <p class="footer__heading"><span>ceam</span></p>
      <?php include "includes/logo.php" ?>
    </div>
    <div class="footer__item">
      <a href="<?php the_field('google_map_url', 'option'); ?>" class="header__link">Location</a>
			<a href="tel:<?php the_field('phone_number', 'option'); ?>" class="header__link">Phone</a>
      <!-- <p class="footer__address"><?php the_field('address', 'option'); ?></p> -->
      <p class="footer__copyright">© <?php echo date("Y"); ?></p>
      <!-- <p class="footer__privacy">Privacy Policy</p>
      <p class="footer__privacy">Legal</p> -->
    </div>
  </div>
</div>
</div> <!-- close wrapper -->

<?php wp_footer(); ?>
</body>
</html>
