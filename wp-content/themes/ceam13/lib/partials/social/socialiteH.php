 <ul id="social2" class="cf">
        <li>
            <a href="http://twitter.com/share" class="socialite twitter-share" data-text="<?php the_title() ?>" data-url="<?php the_permalink() ?>" data-count="horizontal" data-via="solvmist" rel="nofollow" target="_blank">
                <span class="vhidden">Share on Twitter</span>
            </a>
        </li>
        <li>
            <a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=http://socialitejs.com" class="socialite googleplus-one" data-size="medium" data-href="<?php the_permalink() ?>" rel="nofollow" target="_blank">
                <span class="vhidden">Share on Google+</span>
            </a>
        </li>
        <li>
            <a href="http://www.facebook.com/sharer.php?u=http://www.socialitejs.com&amp;t=Socialite.js" class="socialite facebook-like" data-href="<?php the_permalink() ?>" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank">
                <span class="vhidden">Share on Facebook</span>
            </a>
        </li>
        <li>
            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&title=<?php the_title() ?>" class="socialite linkedin-share" data-url="<?php the_permalink() ?>" data-counter="right" rel="nofollow" target="_blank">
                <span class="vhidden">Share on LinkedIn</span>
            </a>
        </li>
        <li>
            <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&amp;media=<?php if(has_post_thumbnail()) { echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); } else { echo bloginfo('template_url').'/images/solvm-logo-2.png'; } ?>&amp;description=<?php the_title() ?>" class="socialite pinterest-pinit" data-count-layout="horizontal">
                <span class="vhidden">Pin It!</span>
            </a>
        </li>
    </ul>