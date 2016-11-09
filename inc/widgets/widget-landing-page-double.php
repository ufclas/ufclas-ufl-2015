<?php 
/**
 * Landing Page Double Image Widget
 *
 * @package UFCLAS_UFL_2015
 * @since 0.4.0
 */
class UFL_2015_Landing_Page_Double extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'widget-ufl-landing-page-double',
			'description' => __('Creates a layout with two images next to each other with content.', 'ufclas-ufl-2015'),
			'customize_selective_refresh' => true,
		);
		$control_ops = array();
		parent::__construct( 'ufl-landing-page-double-image', __('UFL Landing Page Double Image', 'ufclas-ufl-2015'), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$title = ( !empty( $instance['title'] ) )? $instance['title'] : ''; 
		$text = ( !empty( $instance['text'] ) )? $instance['text'] : '';
		$image1 = ( !empty( $instance['image1'] ) )? $instance['image1'] : '';
		$image2 = ( !empty( $instance['image2'] ) )? $instance['image2'] : '';
        
        // Apply filters
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $text = apply_filters( 'widget_text', $text, $instance, $this );
        
		echo $args['before_widget'];
		
        echo do_shortcode( sprintf(
			'[ufl-landing-page-double-image headline="%s" image1="%s" image2="%s"]%s[/ufl-landing-page-double-image]',
			$title,
			$image1,
			$image2,
			$text
		));
		
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
			'image1' => '',
			'image2' => '',
		) );
		
		$title = sanitize_text_field( $instance['title'] );
		$image1 = ( isset( $instance['image1'] ) )? $instance['image1'] : '';
		$image2 = ( isset( $instance['image2'] ) )? $instance['image2'] : '';
			
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Headline:', 'ufclas-ufl-2015'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:', 'ufclas-ufl-2015' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>
		
        <p>
        <label for="<?php echo $this->get_field_id( 'image1' ); ?>"><?php _e( 'Primary Image', 'ufclas-ufl-2015' ); ?>:</label>
        <div class="wpshed-media-container">
            <div class="wpshed-media-inner">
                <?php $img_style = ( $instance[ 'image1' ] != '' ) ? '' : 'style="display:none;"'; ?>
                <img id="<?php echo $this->get_field_id( 'image1' ); ?>-preview" src="<?php echo esc_attr( $instance['image1'] ); ?>" <?php echo $img_style; ?> />
                <?php $no_img_style = ( $instance[ 'image1' ] != '' ) ? 'style="display:none;"' : ''; ?>
                <span class="wpshed-no-image" id="<?php echo $this->get_field_id( 'image1' ); ?>-noimg" <?php echo $no_img_style; ?>><?php _e( 'No image selected', 'ufclas-ufl-2015' ); ?></span>
            </div>
        <input type="text" id="<?php echo $this->get_field_id( 'image1' ); ?>" name="<?php echo $this->get_field_name( 'image1' ); ?>" value="<?php echo esc_attr( $instance['image1'] ); ?>" class="wpshed-media-url" />
		<input type="button" value="<?php echo _e( 'Remove', 'ufclas-ufl-2015' ); ?>" class="button wpshed-media-remove" id="<?php echo $this->get_field_id( 'image1' ); ?>-remove" <?php echo $img_style; ?> />
		<?php $image_button_text = ( $instance[ 'image1' ] != '' ) ? __( 'Change Image', 'ufclas-ufl-2015' ) : __( 'Select Image', 'ufclas-ufl-2015' ); ?>
        <input type="button" value="<?php echo $image_button_text; ?>" class="button wpshed-media-upload" id="<?php echo $this->get_field_id( 'image1' ); ?>-button" />
        <br class="clear">
        </div>
        </p>
		
        <p>
        <label for="<?php echo $this->get_field_id( 'image2' ); ?>"><?php _e( 'Secondary Image', 'ufclas-ufl-2015' ); ?>:</label>
        <div class="wpshed-media-container">
            <div class="wpshed-media-inner">
                <?php $img_style = ( $instance[ 'image2' ] != '' ) ? '' : 'style="display:none;"'; ?>
                <img id="<?php echo $this->get_field_id( 'image2' ); ?>-preview" src="<?php echo esc_attr( $instance['image2'] ); ?>" <?php echo $img_style; ?> />
                <?php $no_img_style = ( $instance[ 'image2' ] != '' ) ? 'style="display:none;"' : ''; ?>
                <span class="wpshed-no-image" id="<?php echo $this->get_field_id( 'image2' ); ?>-noimg" <?php echo $no_img_style; ?>><?php _e( 'No image selected', 'ufclas-ufl-2015' ); ?></span>
            </div>
        <input type="text" id="<?php echo $this->get_field_id( 'image2' ); ?>" name="<?php echo $this->get_field_name( 'image2' ); ?>" value="<?php echo esc_attr( $instance['image2'] ); ?>" class="wpshed-media-url" />
		<input type="button" value="<?php echo _e( 'Remove', 'ufclas-ufl-2015' ); ?>" class="button wpshed-media-remove" id="<?php echo $this->get_field_id( 'image2' ); ?>-remove" <?php echo $img_style; ?> />
		<?php $image_button_text = ( $instance[ 'image2' ] != '' ) ? __( 'Change Image', 'ufclas-ufl-2015' ) : __( 'Select Image', 'ufclas-ufl-2015' ); ?>
        <input type="button" value="<?php echo $image_button_text; ?>" class="button wpshed-media-upload" id="<?php echo $this->get_field_id( 'image2' ); ?>-button" />
        <br class="clear">
        </div>
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
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = wp_kses_post( $new_instance['text'] );
		}
		$instance['image1'] = esc_url_raw( $new_instance['image1'] );
		$instance['image2'] = esc_url_raw( $new_instance['image2'] );
		
		return $instance;
	}
}