<?php

add_action('wp_enqueue_scripts', function () {
    $manifest = json_decode(file_get_contents('./wp-content/themes/ceam2018/build/assets.json', true));
    $main = $manifest->main;
    wp_enqueue_style('theme-css', get_template_directory_uri() . "/build/" . $main->css,  false, null);
    wp_enqueue_script('theme-js', get_template_directory_uri() . "/build/" . $main->js, ['jquery'], null, true);
}, 100);

    // if (is_single("7049")) {

    //     wp_enqueue_script('hogan', get_bloginfo('template_url') . '/vendor/hogan/lib/hogan.js', array('jquery'), '1.0', true);
    //     wp_enqueue_script('typeahead', get_bloginfo('template_url') . '/vendor/typeahead/typeahead.min.js', array('jquery'), '1.0', true);


    //     wp_enqueue_script('msip5', get_bloginfo('template_url') . '/vendor/msip5/msip5.js', array('jquery'), '1.0', true);
    //     }


    // if (is_single("7466")) {

    //     wp_enqueue_script('hogan', get_bloginfo('template_url') . '/vendor/hogan/lib/hogan.js', array('jquery'), '1.0', true);
    //     wp_enqueue_script('typeahead', get_bloginfo('template_url') . '/vendor/typeahead/typeahead.min.js', array('jquery'), '1.0', true);


    //     wp_enqueue_script('msip5_2014', get_bloginfo('template_url') . '/vendor/msip5/msip5_2014.js', array('jquery'), '1.0', true);
    //     }


    // if (is_single("7782")) {

    //     wp_enqueue_script('hogan', get_bloginfo('template_url') . '/vendor/hogan/lib/hogan.js', array('jquery'), '1.0', true);
    //     wp_enqueue_script('typeahead', get_bloginfo('template_url') . '/vendor/typeahead/typeahead.min.js', array('jquery'), '1.0', true);


    //     wp_enqueue_script('superintendant', get_bloginfo('template_url') . '/vendor/typeahead/superintendant-information.js', array('jquery'), '1.0', true);
    //     }


