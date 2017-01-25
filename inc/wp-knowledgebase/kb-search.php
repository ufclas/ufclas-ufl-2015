<?php
/**
 * Knowledgebase header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UFCLAS_UFL_2015
 */
if ( have_posts() ) : ?>

    <ul id="search-result">
    
    <?php  while (have_posts()) : the_post(); ?>
        
        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            
    <?php endwhile; ?>
    </ul>

<?php else: ?>
        <span class="kbe_no_result">Search result not found......</span>
<?php
endif;