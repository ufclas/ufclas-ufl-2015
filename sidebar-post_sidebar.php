<?php
/**
 * The page sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UFCLAS_UFL_2015
 */

if ( ! is_active_sidebar( 'post_sidebar' ) ): ?>

<div id="secondary" class="widget-area" role="complementary">
    <?php the_widget( 'WP_Widget_Recent_Posts', array('title' => __('Recent News'), 'number' => 5, 'show_date' => 1) ); ?>
    <?php the_widget( 'WP_Widget_Archives', array('title' => __('News Archive'), 'dropdown' => 1) ); ?>
	<?php the_widget( 'WP_Widget_Categories', array('dropdown' => 1, 'hierarchical' => 1) ); ?> 
</div><!-- post_sidebar -->

<?php else: ?>

<div id="secondary" class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'post_sidebar' ); ?>
</div><!-- post_sidebar -->

<?php endif; ?>