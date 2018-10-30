<div class="post-author">
	<?php ct_shift_profile_image_output(); ?>
	<h3><?php echo get_the_author(); ?></h3>
	<?php ct_shift_social_icons_output('author') ?>
	<p><?php the_author_meta('description'); ?></p>
	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php esc_html_e( 'View more posts', 'shift' ); ?></a>
</div>