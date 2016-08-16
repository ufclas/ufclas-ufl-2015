<?php 
/**
 * The Events Calendar functions 
 */
 
 
 /**
 * Event List Widget: Add the month and day before the title
 */
function ufclas_ufl_2015_events_widget_title(){
	global $post;
	
	// Change format of the start date for styling as an icon
	$tribe_post_month = tribe_get_start_date( $post, false, 'M' );
	$tribe_post_day = tribe_get_start_date( $post, false, 'd' );
	?>
    
    <div class="event-date">
    	<span class="event-month"><?php echo $tribe_post_month; ?></span>
        <span class="event-day"><?php echo $tribe_post_day; ?></span>
   	</div>
    
    <?php 
}
add_action( 'tribe_events_list_widget_before_the_event_title', 'ufclas_ufl_2015_events_widget_title' );