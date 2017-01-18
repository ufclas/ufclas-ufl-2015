<?php 
/**
 * Submenu Widget
 *
 * @package UFCLAS_UFL_2015
 * @since 0.7.0
 */
class UFL_2015_Submenu extends WP_Nav_Menu_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'widget-ufl-submenu',
			'description' => __('Creates a submenu with title', 'ufclas-ufl-2015'),
			'customize_selective_refresh' => true,
		);
		$control_ops = array();
		parent::__construct( 'ufl-submenu', __('UFL Submenu', 'ufclas-ufl-2015'), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$title = ( !empty( $instance['title'] ) )? $instance['title'] : ''; 
		$subtitle = ( !empty( $instance['subtitle'] ) )? $instance['subtitle'] : '';
		$image = ( !empty( $instance['image'] ) )? $instance['image'] : '';
		$image_height = ( !empty( $instance['image_height'] ) )? $instance['image_height'] : '';
		$background = ( !empty( $instance['background'] ) )? $instance['background'] : '';
        
        // Apply filters
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $subtitle = apply_filters( 'widget_title', $text, $instance, $this );
        
		echo $args['before_widget'];
		
        echo do_shortcode( sprintf(
			'[ufl-submenu headline="%s" subtitle="%s" image="%s" image_height="%s" background="%s"]',
			$menu,
			$title,
			$subtitle,
			$image,
			$image_height,
			$background
		));
		
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'image_height' => '', 'button_text' => '', 'button_link' => '', 'image' => '' ) );
		
		$title = sanitize_text_field( $instance['title'] );
		$image = ( isset( $instance['image'] ) )? $instance['image'] : '';
		$image_heights = array(
			'large' => esc_html__( 'Large', 'ufclas-ufl-2015' ),
			'medium' => esc_html__( 'Medium', 'ufclas-ufl-2015' ),
			'half' => esc_html__( 'Small', 'ufclas-ufl-2015' ),
		);
		$image_height = sanitize_text_field( $instance['image_height'] );
		$button_text = sanitize_text_field( $instance['button_text'] );
		$button_link = esc_url_raw( $instance['button_link'] );
		
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Headline:', 'ufclas-ufl-2015'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:', 'ufclas-ufl-2015' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>
		
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
        <label for="<?php echo $this->get_field_id( 'image_height' ); ?>"><?php _e( 'Background Image Height:', 'ufclas-ufl-2015' ); ?></label>
        <select id="<?php echo $this->get_field_id( 'image_height' ); ?>" name="<?php echo $this->get_field_name( 'image_height' ); ?>">
        <?php foreach ( $image_heights as $value => $label ) : ?>
            <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $image_height, $value ); ?>>
                <?php echo esc_html( $label ); ?>
            </option>
        <?php endforeach; ?>
        </select>
        </p>

        
        <p><label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text:', 'ufclas-ufl-2015'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Button Link:', 'ufclas-ufl-2015'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo esc_attr($button_link); ?>" /></p>
		
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
		$instance['image'] = esc_url_raw( $new_instance['image'] );
		$instance['image_height'] = sanitize_text_field( $new_instance['image_height'] );
		$instance['button_text'] = sanitize_text_field( $new_instance['button_text'] );
		$instance['button_link'] = esc_url_raw( $new_instance['button_link'] );
		
		return $instance;
	}
}