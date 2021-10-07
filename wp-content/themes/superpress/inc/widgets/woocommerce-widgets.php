<?php 
/**
 * Recent product slider
 */
class superpress_recent_product_slider_widgets extends WP_Widget {
 	function __construct() {
		parent::__construct(
			'superpress_recent_product_slider_widgets', 
			esc_html__( '*superpress - Recent Products Slider', 'superpress' ), 
			array( 'description' => esc_html__( 'superpress Recent Products Slider', 'superpress' ), )
		);
	}
 	public function widget( $args, $instance ) {
		?>
		<?php
		echo wp_kses_post( $args['before_widget'] );
		$superpress_recent_product_slider_post_title = isset($instance['superpress_recent_product_slider_post_title']) ? $instance['superpress_recent_product_slider_post_title'] : '';
		$superpress_recent_product_slider_number_of_product = isset($instance['superpress_recent_product_slider_number_of_product']) ? $instance['superpress_recent_product_slider_number_of_product'] : 5;
		?>
		<div class="superpress-recent-product-slider superpress-recent superpress-recent-slider woocommerce">
			<?php if (!empty($superpress_recent_product_slider_post_title)): ?>
				<h4 class="widget-title"><?php echo esc_html($superpress_recent_product_slider_post_title); ?></h4>
			<?php endif ?>
			<?php 
			$most_viewed_args = array(
				'post_type'=>'product',
				'posts_per_page'=> $superpress_recent_product_slider_number_of_product,
				'order'=>'desc',
			);
 			$superpress_most_viewed_post_item = new wp_query($most_viewed_args);
			if ($superpress_most_viewed_post_item->have_posts()) { 
				wp_enqueue_style( 'slick-theme');
				wp_enqueue_style( 'slick');
				wp_enqueue_script( 'slick');
				?>
 				<ul id="superpress-recent-product-slider-holder" class="superpress-recent-product-slider-holder">
					<?php while ($superpress_most_viewed_post_item->have_posts()) {
						$superpress_most_viewed_post_item->the_post();
						?>
						<li class="superpress-recent-product-slider-item">
							<div class="superpress-recent-product-slider-item-holder">
								<?php if (has_post_thumbnail()): ?>
									<figure>
										<a href="<?php the_permalink();?>">
											<img src="<?php the_post_thumbnail_url('superpress_widget_rcp_size'); ?>" alt="<?php echo esc_attr(get_the_title());?>">
										</a>
									</figure>
								<?php endif ?>
								<div class="superpress-recent-post-content">
									<h4><a href="<?php the_permalink();?>"> <?php the_title(); ?></a></h4>
									<?php 
									$regular_price = get_post_meta( get_the_ID(), '_regular_price', true ); 
									$sale_price = get_post_meta( get_the_ID(), '_sale_price', true ); 
									$price = get_post_meta( get_the_ID(), '_price', true );
									?>
									<?php woocommerce_template_loop_rating();  ?>
									<?php 
									if (!empty($sale_price)) { ?>
										<del> <?php echo wp_kses_post(wc_price( $regular_price )); ?></del>
										<ins> <?php echo wp_kses_post(wc_price( $sale_price )); ?></ins>
										<?php
									}else{ ?>
										<ins> <?php echo wp_kses_post(wc_price( $price )); ?></ins>
									<?php } ?>
								</div>
							</div>
						</li>
					<?php } wp_reset_postdata(); ?>
				</ul>
			<?php } ?>
		</div>
		<?php
		echo wp_kses_post($args['after_widget']);
	}
 	public function form( $instance ) {
		$superpress_recent_product_slider_post_title = ! empty( $instance['superpress_recent_product_slider_post_title'] ) ? $instance['superpress_recent_product_slider_post_title'] : __('Recent Products','superpress');
		$superpress_recent_product_slider_number_of_product = ! empty( $instance['superpress_recent_product_slider_number_of_product'] ) ? $instance['superpress_recent_product_slider_number_of_product'] : 5;
 		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_product_slider_post_title' ) ); ?>"><?php esc_html_e( 'Title:', 'superpress' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_product_slider_post_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'superpress_recent_product_slider_post_title' ) ); ?>" type="text" value="<?php echo esc_attr( $superpress_recent_product_slider_post_title ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_product_slider_number_of_product' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'superpress' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_product_slider_number_of_product' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'superpress_recent_product_slider_number_of_product' ) ); ?>" type="number" value="<?php echo esc_attr( $superpress_recent_product_slider_number_of_product ); ?>">
		</p>
		<?php 
	}
 	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['superpress_recent_product_slider_number_of_product'] = ( ! empty( $new_instance['superpress_recent_product_slider_number_of_product'] ) ) ? absint( $new_instance['superpress_recent_product_slider_number_of_product'] ) : '';
		$instance['superpress_recent_product_slider_post_title'] = ( ! empty( $new_instance['superpress_recent_product_slider_post_title'] ) ) ? sanitize_text_field( $new_instance['superpress_recent_product_slider_post_title'] ) : '';
 		return $instance;
	}
 } 
 function superpress_recent_product_slider_widgets_register() {
	register_widget( 'superpress_recent_product_slider_widgets' );
}
add_action( 'widgets_init', 'superpress_recent_product_slider_widgets_register' );
