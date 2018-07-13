<!--footer section-->
<div class="footer__layer">
  <div class="footer__container">
    <div class="footer__item">
      <p class="footer__heading"><span>ceam</span></p>
      <?php include "includes/logo.php" ?>
      <p class="footer__copyright">© <?php echo date("Y"); ?></p>
      <p class="footer__address"><?php the_field('address', 'option'); ?></p>
    </div>
    <div class="footer__item">
      <!-- <p class="footer__privacy">Privacy Policy</p>
      <p class="footer__privacy">Legal</p> -->
    </div>
  </div>
</div>
</div> <!-- close wrapper -->

<?php wp_footer(); ?>
</body>
</html>
