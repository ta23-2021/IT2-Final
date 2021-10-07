<?php 
class superpress_recent_post_widgets extends WP_Widget {
	function __construct() {
		parent::__construct(
			'superpress_recent_post_widgets', // Base ID
			esc_html__( 'superpress - Recent Posts', 'superpress' ), // Name
			array( 'description' => esc_html__( 'superpress Recent Posts', 'superpress' ), ) // Args
		);
	}
	public function widget( $args, $instance ) {
		?>
		<?php
		echo wp_kses_post( $args['before_widget'] );
		$superpress_recent_post_title = isset($instance['superpress_recent_post_title']) ? $instance['superpress_recent_post_title'] : '';
		$superpress_recent_post_per_page = isset($instance['superpress_recent_post_per_page']) ? $instance['superpress_recent_post_per_page'] : '';
		$hide_recent_post_sticky_post = isset($instance['hide_recent_post_sticky_post']) ? $instance['hide_recent_post_sticky_post'] : '';
		$hide_recent_post_date = isset($instance['hide_recent_post_date']) ? $instance['hide_recent_post_date'] : '';
		if ($hide_recent_post_sticky_post == 1) {
			$ingnore_sticky_value = 1;
		}else{
			$ingnore_sticky_value = 0;
		}
		?>
		<div class="superpress-recent-posts superpress-recent">
			<?php if (!empty($superpress_recent_post_title)): ?>
				<h4 class="widget-title"><?php echo esc_html($superpress_recent_post_title); ?></h4>
			<?php endif ?>
			<?php 
			$recent_args = array(
				'post_type'=>'post',
				'posts_per_page'=> $superpress_recent_post_per_page,
				'ignore_sticky_posts' => $ingnore_sticky_value,
				'order'=>'desc',
			);
			$superpress_recent_post_item = new wp_query($recent_args);
			if ($superpress_recent_post_item->have_posts()) { 
				$i = 1 ;
				?>
				<ul class="superpress-recent-post-holder">
					<?php while ($superpress_recent_post_item->have_posts()) {
						$superpress_recent_post_item->the_post();
						$count_of_recent_post = $i++;
						if ( ($count_of_recent_post < 2) && !$ingnore_sticky_value ) {
							$recent_post_class = 'recent-post-full';
							$recent_post_img_size = 'widget_rcp_size';
						}else{
							$recent_post_class = 'recent-post-default';
							$recent_post_img_size = 'thumbnail';
						}
						?>
						<li class="superpress-recent-post-item <?php echo esc_attr($recent_post_class);?>">
								<?php if (has_post_thumbnail( null )): ?>
									<figure>
										<a href="<?php the_permalink();?>">
											<img src="<?php the_post_thumbnail_url($recent_post_img_size); ?>" alt="<?php echo esc_attr(get_the_title());?>">
										</a>
									</figure>
								<?php endif ?>
								<div class="superpress-recent-post-content">
									<?php if ($hide_recent_post_date != 1): ?>										
										<span class="mdates"><?php echo get_the_date('M d, Y');?>
									</span>
								<?php endif ?>
								<?php 
								if ( ($count_of_recent_post < 2) && !$ingnore_sticky_value ){ ?>
									<h5>
									<a href="<?php the_permalink();?>"> <?php the_title(); ?></a>
									</h5>
									<p>
										<?php 	
										$count_number = 50;
										$content = get_the_content(); 
										$count_content = strlen($content);
										$content = get_the_excerpt();
										echo wp_kses_post(substr($content, 0, $count_number));
										if($count_content > $count_number): 
											echo esc_html('...');
										endif;
										?>
									</p>
								<?php }else{
									?>
									<h6>
									<a href="<?php the_permalink();?>"> <?php the_title(); ?></a>
									</h6>
									<?php
								} ?>
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
	$superpress_recent_post_title = ! empty( $instance['superpress_recent_post_title'] ) ? $instance['superpress_recent_post_title'] : __('Recent Posts','superpress');
	$superpress_recent_post_per_page = ! empty( $instance['superpress_recent_post_per_page'] ) ? $instance['superpress_recent_post_per_page'] : 5;
	$hide_recent_post_sticky_post = ! empty( $instance['hide_recent_post_sticky_post'] ) ? $instance['hide_recent_post_sticky_post'] : '';
	$hide_recent_post_date = ! empty( $instance['hide_recent_post_date'] ) ? $instance['hide_recent_post_date'] : '';
	?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_post_title' ) ); ?>"><?php esc_html_e( 'Title:', 'superpress' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_post_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'superpress_recent_post_title' ) ); ?>" type="text" value="<?php echo esc_attr( $superpress_recent_post_title ); ?>">
		<label for="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_post_per_page' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'superpress' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_post_per_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'superpress_recent_post_per_page' ) ); ?>" type="number" value="<?php echo esc_attr( $superpress_recent_post_per_page ); ?>">
		<label style="width: 100%;
		padding: 10px 0; margin-right: 20px; display:inline-block"><?php esc_html_e( 'Hide Sticky posts', 'superpress' ) ?> 
		<input class="checkbox"
		<?php if ( isset( $hide_recent_post_sticky_post ) && $hide_recent_post_sticky_post=='1' ) { echo 'checked="checked"'; } ?>
		id = "<?php echo esc_attr($this->get_field_id( 'hide_recent_post_sticky_post' )); ?>"
		name = "<?php echo esc_attr($this->get_field_name( 'hide_recent_post_sticky_post' )); ?>"
		value = "1"
		type = "checkbox"
		style="float: right; margin-top: px;"
		/>
	</label>
	<label style="width: 100%;
	padding: 10px 0; margin-right: 20px; display:inline-block"><?php esc_html_e( 'Hide Date', 'superpress' ) ?> 
	<input class="checkbox"
	<?php if ( isset( $hide_recent_post_date ) && $hide_recent_post_date=='1' ) { echo 'checked="checked"'; } ?>
	id = "<?php echo esc_attr($this->get_field_id( 'hide_recent_post_date' )); ?>"
	name = "<?php echo esc_attr($this->get_field_name( 'hide_recent_post_date' )); ?>"
	value = "1"
	type = "checkbox"
	style="float: right; margin-top: px;"
	/>
</label>
</p>
<?php 
}
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['superpress_recent_post_per_page'] = ( ! empty( $new_instance['superpress_recent_post_per_page'] ) ) ? absint( $new_instance['superpress_recent_post_per_page'] ) : '';
	$instance['superpress_recent_post_title'] = ( ! empty( $new_instance['superpress_recent_post_title'] ) ) ? sanitize_text_field( $new_instance['superpress_recent_post_title'] ) : '';
	$instance['hide_recent_post_sticky_post'] = ( ! empty( $new_instance['hide_recent_post_sticky_post'] ) ) ? absint( $new_instance['hide_recent_post_sticky_post'] ) : '';
	$instance['hide_recent_post_date'] = ( ! empty( $new_instance['hide_recent_post_date'] ) ) ? absint( $new_instance['hide_recent_post_date'] ) : '';
	return $instance;
}
} 
function superpress_recent_post_widgets_register() {
	register_widget( 'superpress_recent_post_widgets' );
}
add_action( 'widgets_init', 'superpress_recent_post_widgets_register' );

/**
 * Recent post slider
 */
class superpress_recent_post_slider_widgets extends WP_Widget {
	function __construct() {
		parent::__construct(
			'superpress_recent_post_slider_widgets', 
			esc_html__( '*superpress - Recent Post Slider', 'superpress' ), 
			array( 'description' => esc_html__( 'superpress Recent Post Slider', 'superpress' ), )
		);
	}
	public function widget( $args, $instance ) {
		?>
		<?php
		echo wp_kses_post( $args['before_widget'] );
		$superpress_recent_post_slider_title = isset($instance['superpress_recent_post_slider_title']) ? $instance['superpress_recent_post_slider_title']:'';
		$superpress_recent_post_slider_item = isset($instance['superpress_recent_post_slider_item']) ? $instance['superpress_recent_post_slider_item']:'';
		$hide_recent_post_slider_date = isset($instance['hide_recent_post_slider_date']) ? $instance['hide_recent_post_slider_date']:'';
		?>
		<div class="superpress-recent-post-slider superpress-recent superpress-recent-slider">
			<?php if (!empty($superpress_recent_post_slider_title)): ?>
				<h4 class="widget-title"><?php echo esc_html($superpress_recent_post_slider_title); ?></h4>
			<?php endif ?>
			<?php 
			$most_viewed_args = array(
				'post_type'=>'post',
				'posts_per_page'=> $superpress_recent_post_slider_item,
				'orderby'=>'date',
				'order'=>'desc',
			);
			$superpress_most_viewed_post_item = new wp_query($most_viewed_args);
			if ($superpress_most_viewed_post_item->have_posts()) { 
				wp_enqueue_style( 'slick-theme');
				wp_enqueue_style( 'slick');
				wp_enqueue_script( 'slick');
				?>
				<ul id="superpress-recent-post-slider-holder" class="superpress-recent-post-slider-holder">
					<?php while ($superpress_most_viewed_post_item->have_posts()) {
						$superpress_most_viewed_post_item->the_post();
						?>
						<li class="superpress-recent-post-slider-item">
							<div class="superpress-recent-post-slider-item-holder">
								<?php if (has_post_thumbnail()): ?>
									<figure>
										<a href="<?php the_permalink();?>">
											<img src="<?php the_post_thumbnail_url('widget_rcp_size'); ?>" alt="<?php echo esc_attr(get_the_title());?>">
										</a>
									</figure>
								<?php endif ?>
								<div class="superpress-recent-post-content">
									<?php if ($hide_recent_post_slider_date != 1): ?>										
										<span class="mdates"><?php echo get_the_date('M d, Y');?></span>
									<?php endif ?>
									<h4>
									<a href="<?php the_permalink();?>"> <?php the_title(); ?></a>
									</h4>
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
		$superpress_recent_post_slider_title = ! empty( $instance['superpress_recent_post_slider_title'] ) ? $instance['superpress_recent_post_slider_title'] : 'Recent Post ';
		$superpress_recent_post_slider_item = ! empty( $instance['superpress_recent_post_slider_item'] ) ? $instance['superpress_recent_post_slider_item'] : 5;
		$hide_recent_post_slider_date = ! empty( $instance['hide_recent_post_slider_date'] ) ? $instance['hide_recent_post_slider_date'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_post_slider_title' ) ); ?>"><?php esc_html_e( 'Title:', 'superpress' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_post_slider_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'superpress_recent_post_slider_title' ) ); ?>" type="text" value="<?php echo esc_attr( $superpress_recent_post_slider_title ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_post_slider_item' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'superpress' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'superpress_recent_post_slider_item' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'superpress_recent_post_slider_item' ) ); ?>" type="number" value="<?php echo esc_attr( $superpress_recent_post_slider_item ); ?>">
			
		<label style="width: 100%;
		padding: 10px 0; margin-right: 20px; display:inline-block"><?php esc_html_e( 'Hide Date', 'superpress' ) ?> 
		<input class="checkbox"
		<?php if ( isset( $hide_recent_post_slider_date ) && $hide_recent_post_slider_date=='1' ) { echo 'checked="checked"'; } ?>
		id = "<?php echo esc_attr($this->get_field_id( 'hide_recent_post_slider_date' )); ?>"
		name = "<?php echo esc_attr($this->get_field_name( 'hide_recent_post_slider_date' )); ?>"
		value = "1"
		type = "checkbox"
		style="float: right; margin-top: px;"
		/>
	</label>
</p>
<?php 
}
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['superpress_recent_post_slider_item'] = ( ! empty( $new_instance['superpress_recent_post_slider_item'] ) ) ? absint( $new_instance['superpress_recent_post_slider_item'] ) : '';
	$instance['superpress_recent_post_slider_title'] = ( ! empty( $new_instance['superpress_recent_post_slider_title'] ) ) ? sanitize_text_field( $new_instance['superpress_recent_post_slider_title'] ) : '';
	$instance['hide_recent_post_slider_date'] = ( ! empty( $new_instance['hide_recent_post_slider_date'] ) ) ? absint( $new_instance['hide_recent_post_slider_date'] ) : '';
	return $instance;
}
} 
function superpress_recent_post_slider_widgets_register() {
	register_widget( 'superpress_recent_post_slider_widgets' );
}
add_action( 'widgets_init', 'superpress_recent_post_slider_widgets_register' );