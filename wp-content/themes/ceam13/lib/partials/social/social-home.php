<ul id="social" class="line socialRight">
  <li class="facebook">
  	<div id="fb-root"></div>
  	<!-- <div class="fb-like" data-href="<?php //bloginfo('url');?>" data-send="true" data-layout="button_count" data-width="120" data-show-faces="false"></div> -->
  	<div class="fb-like" data-href="<?php if(is_single()) { the_permalink(); } else { bloginfo('url'); } ?>" data-send="true" data-layout="button_count" data-width="120" data-show-faces="false"></div>
  </li>
  <li class="twitter">
    <a href="http://twitter.com/share" data-url="<?php bloginfo('url');?>" 
      data-text="F5 Records" data-via="f5records" 
      class="twitter-share-button">Tweet</a>
  </li>
  <li class="plusone">
    <g:plusone size="medium" callback="plusone_vote"></g:plusone>
  </li>
  
  <li class="linkedin">
    <script type="in/share" data-url="<?php bloginfo('url');?>" 
      data-counter="right"></script>
  </li>
  <!--  
  <li class="lastUnit size1of5">
    <div id="stumbleupon-button"></div>
  </li>
  -->
</ul>