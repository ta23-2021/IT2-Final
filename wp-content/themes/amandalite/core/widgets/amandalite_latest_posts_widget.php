<?php
class AmandaLite_Widget_Latest_Posts_Widget extends WP_Widget
{
	function __construct()
    {
		$widget_ops = array( 'classname' => 'amandalite_latest_posts_widget', 'description' => esc_html__('A widget that displays your latest posts from all categories or a certain', 'amandalite') );
		parent::__construct( 'amandalite_latest_posts_widget', esc_html__('AmandaLite: Latest Posts', 'amandalite'), $widget_ops );
	}

	function widget( $args, $instance )
    {
		extract( $args );
		$title        = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : esc_html__('Latest Posts', 'amandalite') );
		$categories   = isset($instance['categories']) ? $instance['categories'] : null;
		$number       = isset($instance['number']) ? $instance['number'] : 4;
		$query        = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat' => $categories);
        
		$loop = new WP_Query($query);
        
		if ( $loop->have_posts() ) :
    		echo wp_kses_post( $before_widget );
    		if ( $title ) {
    		    echo wp_kses_post( $before_title . $title . $after_title );
    		} ?>
			<div class="widget-blog-list list-latest-posts">
			<?php  
				$i = 0;
				while ( $loop->have_posts() ) : $loop->the_post(); $i++; ?>
                <article <?php post_class(); ?>>
                	<div class="post-inner">
	                    <?php
	                        $featured_image = amandalite_resize_image( get_post_thumbnail_id(), null, 100, 100, true, true );
	                    ?>
	                    <div class="post-image">
	                        <a href="<?php the_permalink(); ?>">
	                        	<img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php the_title_attribute() ?>">
	                        </a>
	                        <span class="post-number"><?php echo wp_kses_post( $i ); ?></span>
	                    </div>
						<div class="post-content">
	                        <h4 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></h4>
	                        <span class="date-post"><?php echo esc_html( get_the_date() ); ?></span>
	                    </div>
                    </div>
                </article>
			<?php endwhile; ?>
            </div><?php
            wp_reset_postdata();
            echo wp_kses_post( $after_widget );
        endif;
	}

	function update( $new_instance, $old_instance )
    {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['number'] = strip_tags( $new_instance['number'] );
		return $instance;
	}

	function form( $instance )
    {
		$defaults = array( 'title' => esc_html__('Latest Posts', 'amandalite'), 'number' => 3, 'categories' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', 'amandalite'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr($instance['title']); ?>"  />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Filter by Category:', 'amandalite'); ?></label> 
    		<select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories" style="width:100%;">
    			<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>><?php esc_html_e('All categories', 'amandalite'); ?></option>
    			<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
    			<?php foreach($categories as $category) { ?>
    			<option value='<?php echo esc_attr($category->term_id); ?>' <?php if ($category->term_id == $instance['categories']) echo esc_attr('selected="selected"'); ?>><?php echo esc_html($category->cat_name); ?></option>
    			<?php } ?>
    		</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e('Number of posts to show:', 'amandalite'); ?></label>
			<input min="1"  type="number" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
		</p>
	<?php
	}
}

add_action( 'widgets_init', 'amandalite_latest_posts_init' );
function amandalite_latest_posts_init() {
	register_widget( 'AmandaLite_Widget_Latest_Posts_Widget' );
}
