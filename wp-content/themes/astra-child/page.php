<?php
/**
* Template Name: Default
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site may use a
* different template.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Astra
* @since 1.0.0
*/

get_header();
?>

    <div id="primary">

        <?php the_content(); ?>

    </div><!-- #primary -->



<?php
get_footer();