<?php
class AmandaLite_Social_Network_Widget extends WP_Widget
{
	public function __construct()
    {
		$widget_ops = array( 'classname' => 'widget_amandalite_social_network', 'description' => esc_html__('A widget that displays your social icons', 'amandalite') );
		parent::__construct( 'widget_amandalite_social_network', esc_html__('AmandaLite: Social Network', 'amandalite'), $widget_ops );
	}
    

	public function widget( $args, $instance )
    {
		extract( $args );
		$title        	= apply_filters('widget_title', $instance['title'] );
		$follow_desc    = isset($instance['follow_desc']) ? $instance['follow_desc'] : '' ;
		$facebook_url 	= get_theme_mod( 'amandalite_facebook_url' );
		$twitter_url 	= get_theme_mod( 'amandalite_twitter_url' );
		$instagram_url 	= get_theme_mod( 'amandalite_instagram_url' );
		$pinterest_url 	= get_theme_mod( 'amandalite_pinterest_url' );
		$youtube_url 	= get_theme_mod( 'amandalite_youtube_url' );
		$vimeo_url 		= get_theme_mod( 'amandalite_vimeo_url' );

		echo wp_kses_post($args['before_widget']);
		if ( $title ) {
            echo wp_kses_post( $before_title . $title . $after_title );
		}

		?>
		<?php if ( $follow_desc ) { ?>
        <div class="follow_desc"><?php echo wp_kses_post($instance['follow_desc']); ?></div>
        <?php } ?>
        <div class="social-network">			
            <?php if ( $facebook_url && $instance['facebook_check'] ) : ?><a class="facebook" href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a><?php endif; ?>

			<?php if ( $twitter_url && $instance['twitter_check']  ) : ?><a class="twitter" href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"><i class="fab fa-twitter"></i></a><?php endif; ?>

			<?php if ( $instagram_url && $instance['instagram_check'] ) : ?><a class="instagram" href="<?php echo esc_url( $instagram_url ); ?>" target="_blank"><i class="fab fa-instagram"></i></a><?php endif; ?>

			<?php if ( $pinterest_url && $instance['pinterest_check']) : ?><a class="pinterest" href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a><?php endif; ?>

            <?php if ( $youtube_url && $instance['youtube_check'] ) : ?><a class="youtube" href="<?php echo esc_url( $youtube_url ); ?>" target="_blank"><i class="fab fa-youtube"></i></a><?php endif; ?>

            <?php if ( $vimeo_url && $instance['vimeo_check'] ) : ?><a class="vimeo" href="<?php echo esc_url( $vimeo_url ); ?>" target="_blank"><i class="fab fa-vimeo-v"></i></a><?php endif; ?>

        </div><?php
		echo wp_kses_post($args['after_widget']);
	}


	public function update( $new_instance, $old_instance )
    {
		$instance                 		= $old_instance;
		$instance['title']        		= strip_tags( $new_instance['title'] );
		$instance['follow_desc']   		= strip_tags($new_instance['follow_desc']);
		$instance['facebook_check']     = strip_tags( $new_instance['facebook_check'] );
		$instance['twitter_check']      = strip_tags( $new_instance['twitter_check'] );
        $instance['instagram_check']    = strip_tags( $new_instance['instagram_check'] );
        $instance['pinterest_check']    = strip_tags( $new_instance['pinterest_check'] );
		$instance['youtube_check']      = strip_tags( $new_instance['youtube_check'] );
		$instance['vimeo_check']        = strip_tags( $new_instance['vimeo_check'] );
		return $instance;
	}


	public function form( $instance )
    {
		$defaults = array(
            'title'              => empty($instance['title']) ? esc_html__('Follow Us', 'amandalite') : $instance['title'],
            'follow_desc'   => '',
            'facebook_check' => '',
            'twitter_check' => '',
            'instagram_check' => '',
            'pinterest_check' => '',
            'youtube_check' => '',
            'vimeo_check' => ''
        );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', 'amandalite'); ?></label>
            <input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr($instance['title']); ?>"  />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_name('follow_desc')); ?>"><?php esc_html_e('Follow Description', 'amandalite'); ?>:</label>
            <textarea rows="8" class="widefat" id="<?php echo esc_attr($this->get_field_id('follow_desc')); ?>" name="<?php echo esc_attr($this->get_field_name('follow_desc')); ?>"><?php echo esc_html($instance['follow_desc']); ?></textarea>
        </p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_check' ) ); ?>"><?php echo esc_html__( 'Facebook :', 'amandalite' ) ?></label>
			<input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook_check' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook_check' ) ); ?>" <?php checked( $instance['facebook_check'], 'on' ); ?> />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter_check' )); ?>"><?php echo esc_html__( 'Twitter :', 'amandalite' ) ?></label>
			<input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter_check' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter_check' ) ); ?>" <?php checked( $instance['twitter_check'], 'on' ); ?>/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'instagram_check' )); ?>"><?php echo esc_html__( 'Instagram :', 'amandalite' ) ?></label>
			<input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram_check' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram_check' ) ); ?>" <?php checked( $instance['instagram_check'], 'on' ); ?>/>
		</p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest_check' )); ?>"><?php echo esc_html__( 'Pinterest :', 'amandalite' ) ?></label>
			<input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest_check' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest_check' ) ); ?>" <?php checked( $instance['pinterest_check'], 'on' ); ?>/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'youtube_check' )); ?>"><?php echo esc_html__( 'Youtube :', 'amandalite' ) ?></label>
			<input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube_check' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube_check' ) ); ?>"<?php checked( $instance['youtube_check'], 'on' ); ?> />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'vimeo_check' )); ?>"><?php echo esc_html__( 'Vimeo :', 'amandalite' ) ?></label>
			<input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo_check' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo_check' ) ); ?>" <?php checked( $instance['vimeo_check'], 'on' ); ?> />
		</p><?php
	}
}

add_action( 'widgets_init', 'widget_amandalite_social_network_init' );
function widget_amandalite_social_network_init() {
	register_widget( 'AmandaLite_Social_Network_Widget' );
}
