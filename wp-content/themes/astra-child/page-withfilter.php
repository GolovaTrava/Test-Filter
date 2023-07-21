<?php
/*
Template Name: Page with Filter
*/

get_header();
?>

<div id="primary">
    <form class="filter" action="" method="POST" id="filter">
        <div class="event-venue">
            <h3>Місто</h3>
            <?php
            if ($terms = get_terms(array('taxonomy' => 'event-venue', 'orderby' => 'name'))) :
                echo '<select name="categoryfilter">';
                foreach ($terms as $term) {
                    echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
                }
                echo '</select>';
            endif; ?>
        </div>

        <div class="event-year">
            <h3>Рік</h3>
            <?php if ($terms = get_terms(array('taxonomy' => 'event-year', 'orderby' => 'name'))) {
                foreach ($terms as $term) {
                    echo '<label><input type="checkbox" name="yearfilter[]" value="' . $term->term_id . '"> ' . $term->name . '</label><br>';
                }
            }?>
        </div>

        <div class="event-month">
            <h3>Місяць</h3>
            <?php if ($terms = get_terms(array('taxonomy' => 'event-month', 'orderby' => 'name'))) {
                foreach ($terms as $term) {
                    echo '<label><input type="checkbox" name="monthfilter[]" value="' . $term->term_id . '"> ' . $term->name . '</label><br>';
                }
            }
            ?>
        </div>

        <div class="submit-wrapper">
            <button class="submit" id="submit">Фільтрувати</button>
        </div>
        <input type="hidden" name="action" value="myfilter">
    </form>

    <div id="response" class="events__row">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'event',
            'orderby' => 'date',
            'order' => $_POST['date'],
            'paged' => $paged,
        );


        $events_query = new WP_Query($args);

        if ($events_query->have_posts()) {
            while ($events_query->have_posts()) : $events_query->the_post();

                echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
            endwhile;
        } else {
            echo 'Нічого не знайдено';
        }
        wp_reset_postdata();?>

    </div>

</div><!-- #primary -->



<?php
get_footer();