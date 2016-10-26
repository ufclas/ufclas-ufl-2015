<?php 
/**
 * Landing Page Hero Widget
 *
 * @package UFCLAS_UFL_2015
 * @since 0.4.0
 */
class UFCLAS_Landing_Page_Hero extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'widget-landing-page-hero',
			'description' => __('Creates a full width image with headline and text.', 'ufclas-ufl-2015'),
			'customize_selective_refresh' => true,
		);
		//$control_ops = array( 'width' => 400, 'height' => 350 );
		$control_ops = array();
		parent::__construct( 'landing-page-hero', __('UF Landing Page Hero', 'ufclas-ufl-2015'), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$text = apply_filters( 'widget_text', $widget_text, $instance, $this );
		$image_height = ! empty( $instance['image_height'] ) ? $instance['image_height'] : '';
		$hide_button = ! empty( $instance['hide_button'] ) ? $instance['hide_button'] : 0;
		$button_text = ! empty( $instance['button_text'] ) ? $instance['button_text'] : '';
		$button_link = ! empty( $instance['button_link'] ) ? $instance['button_link'] : '';

		echo $args['before_widget'];
		
		echo do_shortcode( sprintf(
			'[ufclas-landing-page-hero-full headline="%s" image_height="%s" hide_button="%d" button_text="%s" button_link="%s"]%s[/ufclas-landing-page-hero-full]',
			$title,
			$image_height,
			$hide_button,
			$button_text,
			$button_link,
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
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'image_height' => '', 'button_text' => '', 'button_link' => '' ) );
		
		$title = sanitize_text_field( $instance['title'] );
		$image_height = sanitize_text_field( $instance['image_height'] );
		$image_heights = array(
			'' => esc_html__( 'Default', 'ufclas-ufl-2015' ),
			'half' => esc_html__( 'Half', 'ufclas-ufl-2015' ),
		);
		$hide_button = isset( $instance['hide_button'] ) ? $instance['hide_button'] : 0;
		$button_text = sanitize_text_field( $instance['button_text'] );
		$button_link = esc_url_raw( $instance['button_link'] );
		
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Headline:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>
		
        <p>
        <label for="<?php echo $this->get_field_id( 'image_height' ); ?>"><?php _e( 'Background Image Height:' ); ?></label>
        <select id="<?php echo $this->get_field_id( 'image_height' ); ?>" name="<?php echo $this->get_field_name( 'image_height' ); ?>">
            <?php foreach ( $image_heights as $value => $label ) : ?>
                <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $image_height, $value ); ?>>
                    <?php echo esc_html( $label ); ?>
                </option>
            <?php endforeach; ?>
        </select>
        </p>
        
		<p><input id="<?php echo $this->get_field_id('hide_button'); ?>" name="<?php echo $this->get_field_name('hide_button'); ?>" type="checkbox"<?php checked( $hide_button ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('hide_button'); ?>"><?php _e('Hide Button'); ?></label></p>
        
        <?php if ( !$hide_button ): ?>
        <p><label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Button Link:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo esc_attr($button_link); ?>" /></p>
		<?php endif;
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

		$instance['image_height'] = sanitize_text_field( $new_instance['image_height'] );
		$instance['hide_button'] = ! empty( $new_instance['hide_button'] );
		$instance['button_text'] = sanitize_text_field( $new_instance['button_text'] );
		$instance['button_link'] = esc_url_raw( $new_instance['button_link'] );
		
		return $instance;
	}
}