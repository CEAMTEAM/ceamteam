<?php

add_action('wp_enqueue_scripts', function () {
    $manifest = json_decode(file_get_contents('./wp-content/themes/ceam2018/build/assets.json', true));
    $main = $manifest->main;
    wp_enqueue_style('theme-css', get_template_directory_uri() . "/build/" . $main->css,  false, null);
    wp_enqueue_script('theme-js', get_template_directory_uri() . "/build/" . $main->js, ['jquery'], null, true);
}, 100);

