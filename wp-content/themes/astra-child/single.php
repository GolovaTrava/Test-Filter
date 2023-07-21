<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header(); ?>


<div id="primary" <?php astra_primary_class(); ?>>

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <?php
        echo '<div class="container">';
        the_content();
        echo '</div>';

    endwhile; // End of the loop.
    ?>

</div><!-- #primary -->



<?php get_footer(); ?>
