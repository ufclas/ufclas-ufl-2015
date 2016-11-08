<?php 
/**
 * Breaker with Cards Widget
 *
 * @package UFCLAS_UFL_2015
 * @since 0.4.0
 */
class UFL_2015_Breaker_Cards extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'widget-ufl-breaker-cards',
			'description' => __('Background Image with content cards.', 'ufclas-ufl-2015'),
			'customize_selective_refresh' => true,
		);
		$control_ops = array();
		parent::__construct( 'ufl-breaker-cards', __('UFL Breaker with Cards', 'ufclas-ufl-2015'), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$title = ( !empty( $instance['title'] ) )? $instance['title'] : ''; 
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$image = ( !empty( $instance['image'] ) )? $instance['image'] : '';
		$category = ( !empty( $instance['category'] ) )? $instance['category'] : 1;

		echo $args['before_widget'];
		
		echo do_shortcode( sprintf(
			'[ufl-breaker-cards headline="%s" image="%s" category="%s"]',
			$title,
			$image,
			$category
		) );
		
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '', 
			'text' => '', 
			'category' => '', 
			'image' => ''
		) );
		
		$title = sanitize_text_field( $instance['title'] );
		$image = ( isset( $instance['image'] ) )? $instance['image'] : '';
		$category = absint( $instance['category'] );
		$categories = get_categories();
		
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Headline:', 'ufclas-ufl-2015'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p>
        <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image', 'ufclas-ufl-2015' ); ?>:</label>
        <div class="wpshed-media-container">
            <div class="wpshed-media-inner">
                <?php $img_style = ( $instance[ 'image' ] != '' ) ? '' : 'style="display:none;"'; ?>
                <img id="<?php echo $this->get_field_id( 'image' ); ?>-preview" src="<?php echo esc_attr( $instance['image'] ); ?>" <?php echo $img_style; ?> />
                <?php $no_img_style = ( $instance[ 'image' ] != '' ) ? 'style="display:none;"' : ''; ?>
                <span class="wpshed-no-image" id="<?php echo $this->get_field_id( 'image' ); ?>-noimg" <?php echo $no_img_style; ?>><?php _e( 'No image selected', 'ufclas-ufl-2015' ); ?></span>
            </div>
        <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>" class="wpshed-media-url" />
		<input type="button" value="<?php echo _e( 'Remove', 'ufclas-ufl-2015' ); ?>" class="button wpshed-media-remove" id="<?php echo $this->get_field_id( 'image' ); ?>-remove" <?php echo $img_style; ?> />
		<?php $image_button_text = ( $instance[ 'image' ] != '' ) ? __( 'Change Image', 'ufclas-ufl-2015' ) : __( 'Select Image', 'ufclas-ufl-2015' ); ?>
        <input type="button" value="<?php echo $image_button_text; ?>" class="button wpshed-media-upload" id="<?php echo $this->get_field_id( 'image' ); ?>-button" />
        <br class="clear">
        </div>
        </p>
        
        <p>
		<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category', 'ufclas-ufl-2015'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" value="<?php echo $category; ?>" style="width:100%">
			<option value="" <?php selected($category); ?>><?php _e('Select Category', 'ufclas-ufl-2015'); ?></option>
            <?php if( !empty( $categories ) ): ?>
			<?php foreach($categories as $cat): ?>
				<option value="<?php echo $cat->term_id ?>" <?php selected($category, $cat->term_id); ?>><?php echo $cat->name; ?></option>
			<?php endforeach; ?>
			<?php endif; ?>
		</select>
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['image'] = esc_url_raw( $new_instance['image'] );
		$instance['category'] = absint( $new_instance['category'] );
		
		return $instance;
	}

}