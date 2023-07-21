<?php


/* Styles and Scripts */

add_action( 'wp_enqueue_scripts', 'astra_child_scripts' );
function astra_child_scripts() {
    wp_enqueue_style( 'main-style', get_stylesheet_uri());
    wp_enqueue_script( 'main-script', get_stylesheet_directory_uri() . '/script.js', array('jquery'), null, true );
}


/* Register Custom Post Types */

add_action( 'init', 'register_post_type_event' );
function register_post_type_event() {

    register_taxonomy('event-venue', array('event'), array(
        'label'                 => 'Venue',
        'labels'                => array(
            'name'              => 'Venue',
            'singular_name'     => 'Venue',
            'search_items'      => 'Search Venues',
            'all_items'         => 'All Venues',

            'edit_item'         => 'Edit',
            'update_item'       => 'Update',
            'add_new_item'      => 'Add',
            'new_item_name'     => 'New',
            'menu_name'         => 'Venue',
        ),
        'description'           => '',
        'public'                => true,
        'show_in_rest' => true,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => false,

        'hierarchical'          => true,
        'rewrite'               => array('slug'=>'event-venue', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
        'show_admin_column'     => true,
    ) );

    register_taxonomy('event-year', array('event'), array(
        'label'                 => 'Year',
        'labels'                => array(
            'name'              => 'Year',
            'singular_name'     => 'Year',
            'search_items'      => 'Search Year',
            'all_items'         => 'All Years',

            'edit_item'         => 'Edit',
            'update_item'       => 'Update',
            'add_new_item'      => 'Add',
            'new_item_name'     => 'New',
            'menu_name'         => 'Year',
        ),
        'description'           => '',
        'public'                => true,
        'show_in_rest' => true,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => false,

        'hierarchical'          => true,
        'rewrite'               => array('slug'=>'event-year', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
        'show_admin_column'     => true,
    ) );

    register_taxonomy('event-month', array('event'), array(
        'label'                 => 'Month',
        'labels'                => array(
            'name'              => 'Month',
            'singular_name'     => 'Month',
            'search_items'      => 'Search Month',
            'all_items'         => 'All Month',

            'edit_item'         => 'Edit',
            'update_item'       => 'Update',
            'add_new_item'      => 'Add',
            'new_item_name'     => 'New',
            'menu_name'         => 'Month',
        ),
        'description'           => '',
        'public'                => true,
        'show_in_rest' => true,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => false,

        'hierarchical'          => true,
        'rewrite'               => array('slug'=>'event-month', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
        'show_admin_column'     => true,
    ) );

    register_post_type('event', array(
        'label'               => 'Event',
        'labels'              => array(
            'name'          => 'Event',
            'singular_name' => 'Event',
            'menu_name'     => 'Event',
            'all_items'     => 'All Events',
            'add_new'       => 'Add',
            'add_new_item'  => 'Add',
            'edit'          => 'Edit',
            'edit_item'     => 'Edit',
            'new_item'      => 'New Event',
        ),
        'description'         => '',
        'public'                => true,
        'show_in_rest'          => true,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => false,
        'hierarchical'          => true,
        'rewrite'               => array( 'slug'=>'event', 'with_front'=>true, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
        'show_admin_column'     => true,
    ) );

}




add_action( 'wp_enqueue_scripts', 'truemisha_jquery_scripts' );

function truemisha_jquery_scripts() {

    wp_enqueue_script( 'jquery' );
    wp_localize_script( 'filter', 'true_obj', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_register_script( 'filter', get_stylesheet_directory_uri() . '/filter.js', array( 'jquery' ), time(), true );
    wp_enqueue_script( 'filter' );

}

add_action( 'wp_ajax_myfilter', 'true_filter_function' );
add_action( 'wp_ajax_nopriv_myfilter', 'true_filter_function' );


function true_filter_function() {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $tax_query = array('relation' => 'AND');

    if (!empty($_POST['categoryfilter'])) {
        $tax_query[] = array(
            'taxonomy' => 'event-venue',
            'field' => 'id',
            'terms' => $_POST['categoryfilter'],
        );
    }

    if (!empty($_POST['yearfilter'])) {
        $tax_query[] = array(
            'taxonomy' => 'event-year',
            'field' => 'id',
            'terms' => $_POST['yearfilter'],
        );
    }

    if (!empty($_POST['monthfilter'])) {
        $tax_query[] = array(
            'taxonomy' => 'event-month',
            'field' => 'id',
            'terms' => $_POST['monthfilter'],
        );
    }

    $args = array(
        'post_type' => 'event',
        'orderby' => 'date',
        'order' => $_POST['date'],
        'paged' => $paged,
    );


    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    } else {
        echo 'Нічого не знайдено';
        wp_die();
    }

    $events_query = new WP_Query($args);

    if ($events_query->have_posts()) {
        while ($events_query->have_posts()) : $events_query->the_post();
            echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
        endwhile;
    } else {
        echo 'Нічого не знайдено';
    }

    wp_reset_postdata();

    die();
}

