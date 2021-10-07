<div class="post-meta">
	<?php if ( get_the_date() ) { ?>
	<div class="date-post">
		<?php echo get_the_date( 'F j, Y'); ?>
	</div>
    <?php } ?>
	<div class="ath-post">
		<span>by</span> <?php the_author() ?>
	</div>
	<div class="post-comment"><?php comments_number(); ?></div>
</div>