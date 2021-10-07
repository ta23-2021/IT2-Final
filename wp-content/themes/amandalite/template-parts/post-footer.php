<div class="post-footer">
	<?php if ( get_the_tags() ) { ?>
    <div class="post-tags">
        <i class="fas fa-tag"></i><?php the_tags('',', '); ?>
    </div>
    <?php } ?>
	<?php get_template_part('template-parts/post', 'share'); ?>
</div>