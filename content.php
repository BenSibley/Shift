<div <?php post_class(); ?>>
	<?php do_action( 'ct_shift_post_before' ); ?>
	<article>
		<div class='post-header'>
			<h1 class='post-title'><?php the_title(); ?></h1>
			<?php get_template_part( 'content/post-meta' ); ?>
		</div>
		<?php ct_shift_featured_image(); ?>
		<div class="post-content">
			<?php ct_shift_output_last_updated_date(); ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array(
				'before' => '<p class="singular-pagination">' . esc_html__( 'Pages:', 'shift' ),
				'after'  => '</p>',
			) ); ?>
			<?php do_action( 'ct_shift_post_after' ); ?>
		</div>
		<div class="after-post-meta">
			<?php get_template_part( 'content/post-categories' ); ?>
			<?php get_template_part( 'content/post-tags' ); ?>
			<?php get_template_part( 'content/post-nav' ); ?>
		</div>
	</article>
	<?php comments_template(); ?>
</div>