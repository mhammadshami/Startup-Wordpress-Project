<?php

// Include NavWalker Class For Bootstrap Navigation Menu
require_once('wp_bootstrap_navwalker.php');

// Add Featured Image Support
add_theme_support('post-thumbnails');

/*
 **  Function To Add My Custom Styles
 ** Added By @Osama
 ** wp_enqueue_style()
 */

function elzero_add_styles()
{
    wp_enqueue_style("bootstrap-css", get_template_directory_uri() . "/css/bootstrap.min.css");
    wp_enqueue_style("fontawesome-css", get_template_directory_uri() . "/css/font-awesome.min.css");
    wp_enqueue_style("main-css", get_template_directory_uri() . "/css/main.css");
}


/* 
 ** Function To Add My Custom
 ** Added By @Osama
 ** wp_enqueue_script()
 */

function elzero_add_scripts()
{

    wp_deregister_script("jquery"); // Remove Registration For Old jQuery
    wp_register_script("jquery", includes_url("/js/jquery/jquery.js"), false, '', true); // Register A New jQuery In Footer
    wp_enqueue_script('jquery'); // Enqueue The New jQuery
    wp_enqueue_script("bootstrap-js", get_template_directory_uri() . "/js/bootstrap.min.js", array('jquery'), false, true);
    wp_enqueue_script("main-js", get_template_directory_uri() . "/js/main.js", array(), false, true);
}

/*
 * Add Custom Menu Support
 *  Added By @Osama
 */

function elzero_register_custom_menu()
{
    // Register Custom Meuns
    register_nav_menus(
        array(
            'bootstrap-menu' => 'Navigation Bar',
            'footer-menu' => 'Footer Menu'
        )
    );
}

function elzero_bootstrap_menu()
{
    wp_nav_menu(
        array(
            'theme_location' => 'bootstrap-menu',
            'menu_class' => 'navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll',
            'container' => false,
            'depth' => 2,
            'walker' => new wp_bootstrap_navwalker()
        )
    );
}

/*
 ** Customize The Except Word Length & Read More Dots
 ** Added By @Osama
 */

function elzero_extend_excerpt_length($length)
{
    if (is_author()) {
        return 40;
    } else if (is_category()) {
        return 50;
    } else {
        return 85;
    }
}

add_filter('excerpt_length', 'elzero_extend_excerpt_length');

function elzero_excerpt_change_dots($more)
{
    return ' ...';
}

add_filter('excerpt_more', 'elzero_excerpt_change_dots');

/*
 ** Add Actions
 ** Added By @Osama
 ** add_action()
 */

// Add Css Styles
add_action('wp_enqueue_scripts', 'elzero_add_styles');
// Add Js Scrpts
add_action('wp_enqueue_scripts', 'elzero_add_scripts');
// Register Custom Menu
add_action('init', 'elzero_register_custom_menu');

// Pagination By Numbers

function numbering_pagination()
{
    global $wp_query; // Make Wp Query Global

    $all_pages = $wp_query->max_num_pages; // Get Al Posts
    $current_page  = max(1, get_query_var('paged')); // Get Current Page

    if ($all_pages > 1) { // Check If Total Pages > 1
        return paginate_links(array(
            'base' => get_pagenum_link() . '%_%',
            'format' => 'page/%#%',
            'current' => $current_page,
            'mid_size' => 2,
            'end_size' => 3
        ));
    }
    echo $current_page;
}

/* add widget */
function mytheme_widgets_init()
{
    register_sidebar(array(
        'name'          => 'Main Sidebar',
        'id'            => 'main-sidebar',
        'description'   => 'Main Sidebar Appears Everywhere',
        'before_widget'    => '<div class="widget-content"/>',
        'after_widget'    => '</div>',
        'before_title'    => '<h3 class="widget-title">',
        'after_title'    => '</h3>',
    ));
}
add_action('widgets_init', 'mytheme_widgets_init');

// Remove Paragraph Element From Posts
function elzero_remove_paragraph($content)
{
    remove_filter('the_content', 'wpautop');

    return $content;
}

add_filter('the_content', 'elzero_remove_paragraph', 0);
